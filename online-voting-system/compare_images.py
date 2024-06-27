import cv2
import numpy as np
from deepface import DeepFace

def compare_images(image1_path, image2_path):
    img1 = cv2.imread(image1_path)
    img2 = cv2.imread(image2_path)

    result = DeepFace.verify(img1, img2)
    return result["verified"]

# Example usage
image1_path = 'uploads/captured_image.png'
image2_path = 'uploads/aadhaar_image.png'

if compare_images(image1_path, image2_path):
    print("Images match")
else:
    print("Images do not match")
