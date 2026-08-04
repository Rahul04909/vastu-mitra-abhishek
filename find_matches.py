import os
import numpy as np
from PIL import Image

en_dir = r"d:\wamp\www\vastu-mitra-abhishek\assets\images\en"
parent_dir = r"d:\wamp\www\vastu-mitra-abhishek\assets\images"

en_images = [f for f in os.listdir(en_dir) if f.endswith(".png")]
parent_images = [f for f in os.listdir(parent_dir) if f.endswith((".png", ".jpg", ".jpeg", ".webp"))]

print(f"Found {len(en_images)} English images and {len(parent_images)} parent images.")

def load_and_resize(path, size=(128, 128)):
    try:
        with Image.open(path) as img:
            # Convert to RGB to ensure 3 channels
            img = img.convert("RGB")
            img = img.resize(size)
            return np.array(img, dtype=np.float32)
    except Exception as e:
        return None

en_data = {}
for f in en_images:
    data = load_and_resize(os.path.join(en_dir, f))
    if data is not None:
        en_data[f] = data

for en_name, en_arr in en_data.items():
    print(f"\nComparing {en_name} ({en_arr.shape}):")
    matches = []
    for p_name in parent_images:
        p_path = os.path.join(parent_dir, p_name)
        p_arr = load_and_resize(p_path)
        if p_arr is not None:
            # Calculate mean squared error
            mse = np.mean((en_arr - p_arr) ** 2)
            matches.append((p_name, mse))
    
    # Sort matches by lowest MSE
    matches.sort(key=lambda x: x[1])
    for i in range(min(5, len(matches))):
        print(f"  Match {i+1}: {matches[i][0]} (MSE: {matches[i][1]:.2f})")
