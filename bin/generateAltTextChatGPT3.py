import os
from PIL import Image
import base64
from io import BytesIO
from openai import OpenAI
client = OpenAI(api_key=os.environ.get("OPENAI_API_KEY", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJVc2VySW5mbyI6eyJpZCI6MTY4NTYsInJvbGVzIjpbImRlZmF1bHQiXSwicGF0aWQiOiIxZGY2NjM0ZS04MjcyLTQxODctODg4Yy00MThiOTMwYjg1YzAifSwiaWF0IjoxNzE5MzQzNDgzLCJleHAiOjE3Mjk3MTE0ODN9.5Vo1VWZI5E9qgegoPBOw2kB-nOVYcxH8jv5MxIn-v1Y"))

# Function to encode an image as base64
def encode_image_to_base64(image_path):
    with Image.open(image_path) as img:
        buffered = BytesIO()
        img.save(buffered, format="JPEG")
        return base64.b64encode(buffered.getvalue()).decode('utf-8')

# Function to generate alt text using ChatGPT-3.5
def generate_alt_text(base64_image):
    prompt = f"Generate a detailed, descriptive alt text for the image below:\n[data:image/jpeg;base64,{base64_image}]"
    
    response = client.chat.completions.create(
        model="text-davinci-003",
        messages=prompt,
        max_tokens=150
    )

    return response.choices[0].text.strip()

# Process all images in the specified directory
def process_directory(directory):
    supported_extensions = ['jpg', 'jpeg', 'png']
    for filename in os.listdir(directory):
        if any(filename.lower().endswith(ext) for ext in supported_extensions):
            image_path = os.path.join(directory, filename)
            base64_image = encode_image_to_base64(image_path)
            alt_text = generate_alt_text(base64_image)
            print(f"Image: {filename}\nAlt Text: {alt_text}\n")

# Set your OpenAI API key
# openai.api_key = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJVc2VySW5mbyI6eyJpZCI6MTY4NTYsInJvbGVzIjpbImRlZmF1bHQiXSwicGF0aWQiOiIxZGY2NjM0ZS04MjcyLTQxODctODg4Yy00MThiOTMwYjg1YzAifSwiaWF0IjoxNzE5MzQzNDgzLCJleHAiOjE3Mjk3MTE0ODN9.5Vo1VWZI5E9qgegoPBOw2kB-nOVYcxH8jv5MxIn-v1Y"

# Directory containing images
image_directory = "/Users/zolhawry/git/enable-a11y/images/main-menu"
process_directory(image_directory)
