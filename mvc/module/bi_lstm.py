import numpy as np
import pandas as pd
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.model_selection import train_test_split
from keras.preprocessing.text import Tokenizer
from keras.preprocessing.sequence import pad_sequences
from keras.models import Sequential
from keras.layers import Dense, Embedding, LSTM, Bidirectional, Dropout, Reshape
from keras.optimizers import Adam
import warnings

warnings.filterwarnings('ignore')

def buildModel():
    """Build and train the model"""

    # Import data
    path = './mvc/module/'
    df = pd.read_csv(path + "sqliv2.csv", encoding='utf-16')
    print("Data Shape:", df.shape)
    df.head(10)

    # Assign X and Y for training
    X = df['Sentence']
    y = df['Label']
    print(X.shape, y.shape)
    print("Dataset Input:", "\n", X.head(5))
    print("Dataset Label:", "\n", y.head(5))

    X = [str(element) for element in X]

    # Tokenization
    max_features = 20000
    tokenizer = Tokenizer(num_words=max_features)
    tokenizer.fit_on_texts(list(X))
    list_tokenized = tokenizer.texts_to_sequences(X)
    print(list_tokenized)

    # Padding sequences
    maxlen = 200
    X_train, X_test, Y_train, Y_test = train_test_split(list_tokenized, y, test_size=0.2, random_state=42)
    X_train = pad_sequences(X_train, maxlen=maxlen, padding='post')
    X_test = pad_sequences(X_test, maxlen=maxlen, padding='post')

    # Build the model
    model = Sequential()
    model.add(Embedding(input_dim=max_features, output_dim=128, input_length=maxlen))
    model.add(Bidirectional(LSTM(32, name='lstm_layer')))
    model.add(Dense(32, activation="relu"))
    model.add(Dropout(0.5))
    model.add(Dense(32, activation="relu"))
    model.add(Dropout(0.5))
    model.add(Dense(1, activation="sigmoid"))

    # Compile the model
    custom_optimizer = Adam(learning_rate=0.00004)
    model.compile(loss='binary_crossentropy',
                  optimizer=custom_optimizer,
                  metrics=['accuracy', 'mean_squared_error'])

    # Print model summary
    model.build(input_shape=(None, maxlen))
    model.summary()

    # import keras.callbacks
    # class PrintEpochInfo(keras.callbacks.Callback):
    #   def on_epoch_end(self, epoch, logs=None):
    #     print(f'Epoch {epoch+1}/{epochs}, Loss: {logs["loss"]}, Accuracy: {logs["accuracy"]}, Validation Loss: {logs["val_loss"]}, Validation Accuracy: {logs["val_accuracy"]}')


    # Train the model
    batch_size = 128
    epochs = 5
    model.fit(X_train, Y_train, batch_size=batch_size, validation_data=(X_test, Y_test), epochs=epochs )

    return model, tokenizer

# Call the function to build and train the model



def predictText(text):
  model, tokenizer = buildModel()
  text = [str(text)]
  tokenizer.fit_on_texts(list(text))
  list_tokenized = tokenizer.texts_to_sequences(text)
  text = pad_sequences(list_tokenized, maxlen=200, padding="post")
  result = model.predict(text)
  return result

import sys
import json
if __name__ == "__main__":
    # Lấy tham số từ dòng lệnh khi gọi script
    parameter_from_php = sys.argv[1] if len(sys.argv) > 1 else None

    # Gọi các hàm và tạo một dictionary chứa kết quả
    result = {
        'buildModel': buildModel(),
        'prediction': predictText(parameter_from_php)
    }

    # In kết quả dưới dạng JSON
    print(json.dumps(result))

