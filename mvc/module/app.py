from flask import Flask, request
from tensorflow.keras.models import load_model
from keras.preprocessing.text import Tokenizer
from keras.preprocessing.sequence import pad_sequences
import tensorflow as tf
from tensorflow.keras.models import model_from_json

import pickle

import json
import h5py

app = Flask(__name__)
# json_path = "D:\Coding\Xampp\htdocs\sqli\mvc\module\model.json"

# # Đường dẫn đến tệp trọng số H5 trên máy tính local
# weights_path = "D:\Coding\Xampp\htdocs\sqli\mvc\module\model_weights.h5"

# # Đọc cấu trúc mô hình từ JSON
# with open(json_path, 'r') as json_file:
#     loaded_model_json = json_file.read()
#     loaded_model = model_from_json(loaded_model_json)

# # Load trọng số cho mô hình
# loaded_model.load_weights(weights_path)
model = load_model('D:\Coding\Xampp\htdocs\sqli\model.h5')
model.summary()

max_features = 20000
tokenizer = Tokenizer(num_words=max_features)

@app.route('/predict', methods=['POST', 'GET'])
def predict():
    try:
        # Lấy dữ liệu từ yêu cầu POST
        data = request.get_json()
        print(data)
        
        # Kiểm tra xem có trường 'text' trong dữ liệu không
        if 'text' in data:
            text = data['text']
            print(text)
            # Xử lý dự đoán
            text = [str(text)]
            tokenizer.fit_on_texts(list(text))
            list_tokenized = tokenizer.texts_to_sequences(text)
            text_sequence = pad_sequences(list_tokenized, maxlen=200, padding="post")
            result = model.predict(text_sequence)
            # Đóng gói kết quả thành một đối tượng JSON
            response_data = {'prediction': result[0][0].tolist()}

            # Trả về chuỗi JSON
            return json.dumps(response_data)
        else:
            return json.dumps({'error': 'Missing "text" field in the request data'})

    except Exception as e:
        return json.dumps({'error': str(e)})

if __name__ == '__main__':
    app.run(port= 3400,debug=True)
