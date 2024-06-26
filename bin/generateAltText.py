import os
from PIL import Image
from transformers import VisionEncoderDecoderModel, ViTFeatureExtractor, AutoTokenizer

def generate_alt_text(image_path):
    # Load the model and tokenizer
    model = VisionEncoderDecoderModel.from_pretrained("nlpconnect/vit-gpt2-image-captioning")
    feature_extractor = ViTFeatureExtractor.from_pretrained("google/vit-base-patch16-224-in21k")
    tokenizer = AutoTokenizer.from_pretrained("gpt2")

    # Open image and prepare features
    image = Image.open(image_path).convert("RGB")
    pixel_values = feature_extractor(images=image, return_tensors="pt").pixel_values

    # Generate captions
    output_ids = model.generate(pixel_values)
    caption = tokenizer.decode(output_ids[0], skip_special_tokens=True)
    return caption

def process_directory(directory):
    # Supported image extensions
    supported_extensions = ["jpg", "jpeg", "png"]
    # Generate alt text for each image in the directory
    for filename in os.listdir(directory):
        if any(filename.lower().endswith(ext) for ext in supported_extensions):
            image_path = os.path.join(directory, filename)
            alt_text = generate_alt_text(image_path)
            print(f"Image: {filename}\nAlt Text: {alt_text}\n")

# Directory containing images
image_directory = "/Users/zolhawry/Pictures"
process_directory(image_directory)
