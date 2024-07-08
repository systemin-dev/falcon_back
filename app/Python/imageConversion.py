from PIL import Image
import os
import sys

def convert_to_png(image_path, quality=85, convert_gray=False):
    if not os.path.isfile(image_path):
        print(f"Impossible de trouver {image_path}.")
        return

    try:
        img = Image.open(image_path)
    except IOError:
        print(f"Impossible d'ouvrir {image_path}.")
        return

    max_width = 1024
    if img.width > max_width:
        height = int((max_width / img.width) * img.height)
        img = img.resize((max_width, height), Image.Resampling.LANCZOS)

    if convert_gray:
        img = img.convert('L')  # Convertir en niveaux de gris

    output_path = os.path.splitext(image_path)[0] + '.webp'
    img.save(output_path, 'WEBP', quality=quality)  # Enregistrer au format WebP avec la qualité spécifiée

    if not image_path.lower().endswith('.webp'):
        try:
            os.remove(image_path)
        except OSError:
            print(f"Impossible de supprimer l'ancienne image : {image_path}.")

    return output_path

if __name__ == '__main__':
    if len(sys.argv) > 1:
        image_path = sys.argv[1]
        image_out = convert_to_png(image_path, quality=90, convert_gray=False)  # Ajuster la qualité ici
        print(image_out)
    else:
        print("Veuillez spécifier le chemin de l'image en argument.")
