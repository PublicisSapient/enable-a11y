import os;
import requests
import pandas as pd
from openai import OpenAI
import sys

client = OpenAI(
    # This is the default and can be omitted
    api_key=os.environ.get("OPENAI_API_KEY"),
)


def generate_alt_text(image_url):
    """
    Generate alt text for a given image URL using OpenAI's PSChat.
    """
    try:
        response = client.chat.completions.create(
            model="gpt4o",
            messages=[
                {"role": "system", "content": "You are a helpful assistant."},
                {"role": "user", "content": f"Generate a descriptive alt text for this image URL: {image_url}"}
            ]
        )
        alt_text = response['choices'][0]['message']['content']
        return alt_text
    except Exception as e:
        print(f"Error generating alt text for URL {image_url}: {str(e)}")
        return None

def process_urls(file_path):
    """
    Process each URL in the given file to generate alt text and save the results to a CSV file.
    """
    try:
        # Read URLs from a file
        with open(file_path, 'r') as file:
            urls = file.read().splitlines()

        # List to hold URL and alt text pairs
        results = []

        # Generate alt text for each URL
        for url in urls:
            alt_text = generate_alt_text(url)
            results.append([url, alt_text])

        # Create a DataFrame and save to CSV
        df = pd.DataFrame(results, columns=['URL', 'Alt Text'])
        df.to_csv('output.csv', index=False)
        print("CSV file has been created successfully.")
    except Exception as e:
        print(f"Error processing file {file_path}: {str(e)}")

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python script.py <path_to_text_file_with_urls>")
        sys.exit(1)

    file_path = sys.argv[1]
    process_urls(file_path)
