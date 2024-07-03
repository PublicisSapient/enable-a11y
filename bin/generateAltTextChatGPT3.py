import os
from PIL import Image
import base64
from io import BytesIO
from openai import OpenAI

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

# Directory containing images
image_directory = "/Users/zolhawry/git/enable-a11y/images/main-menu"
process_directory(image_directory)
