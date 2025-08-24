import os
import shutil

# Base paths
SOURCE_SCREENSHOTS = "./screenshots"  # where your JPGs currently are
DEST_BASE = "."  # where appid folders will be created

# AppID -> list of JPG filenames (thumbs listed)
app_images = {
    "90021": ["0000000108_thumb.jpg","0000000107_thumb.jpg","0000000106_thumb.jpg","0000000105_thumb.jpg","0000000104_thumb.jpg"],
    "90009": ["0000000078_thumb.jpg","0000000077_thumb.jpg","0000000076_thumb.jpg","0000000075_thumb.jpg","0000000074_thumb.jpg"],
    "90001": ["0000000221_thumb.jpg","0000000220_thumb.jpg","0000000219_thumb.jpg","0000000218_thumb.jpg","0000000217_thumb.jpg"],
    "90026": ["0000000235_thumb.jpg","0000000234_thumb.jpg","0000000233_thumb.jpg","0000000232_thumb.jpg"],
    "90006": ["0000000063_thumb.jpg","0000000062_thumb.jpg","0000000061_thumb.jpg","0000000060_thumb.jpg","0000000059_thumb.jpg"],
    "92": ["0000000041_thumb.jpg","0000000040_thumb.jpg","0000000039_thumb.jpg","0000000038_thumb.jpg","0000000037_thumb.jpg"],
    "10": ["0000000136_thumb.jpg","0000000135_thumb.jpg","0000000134_thumb.jpg","0000000133_thumb.jpg","0000000132_thumb.jpg"],
    "80": ["0000000141_thumb.jpg","0000000140_thumb.jpg","0000000139_thumb.jpg","0000000138_thumb.jpg","0000000137_thumb.jpg"],
    "240": ["0000000031_thumb.jpg","0000000030_thumb.jpg","0000000029_thumb.jpg","0000000028_thumb.jpg","0000000027_thumb.jpg"],
    "1600": ["0000000252_thumb.jpg","0000000251_thumb.jpg","0000000250_thumb.jpg","0000000249_thumb.jpg","0000000248_thumb.jpg"],
    "1500": ["0000000231_thumb.jpg","0000000230_thumb.jpg","0000000229_thumb.jpg","0000000228_thumb.jpg","0000000227_thumb.jpg"],
    "30": ["0000000173_thumb.jpg","0000000172_thumb.jpg","0000000171_thumb.jpg","0000000170_thumb.jpg","0000000169_thumb.jpg"],
    "300": ["0000000045_thumb.jpg","0000000044_thumb.jpg","0000000043_thumb.jpg","0000000042_thumb.jpg","0000000023_thumb.jpg"],
    "40": ["0000000145_thumb.jpg","0000000144_thumb.jpg","0000000143_thumb.jpg","0000000142_thumb.jpg"],
    "90023": ["0000000213_thumb.jpg","0000000212_thumb.jpg"],
    "90003": ["0000000178_thumb.jpg","0000000177_thumb.jpg","0000000176_thumb.jpg","0000000175_thumb.jpg","0000000174_thumb.jpg"],
    "90014": ["0000000088_thumb.jpg","0000000087_thumb.jpg","0000000086_thumb.jpg","0000000085_thumb.jpg","0000000084_thumb.jpg"],
    "90024": ["0000000216_thumb.jpg","0000000215_thumb.jpg","0000000214_thumb.jpg"],
    "70": ["0000000150_thumb.jpg","0000000149_thumb.jpg","0000000147_thumb.jpg","0000000146_thumb.jpg"],
    "220": ["0000000194_thumb.jpg","0000000193_thumb.jpg","0000000192_thumb.jpg","0000000118_thumb.jpg","0000000114_thumb.jpg"],
    "90013": ["0000000191_thumb.jpg"],
    "219": ["0000000199_thumb.jpg","0000000198_thumb.jpg","0000000197_thumb.jpg","0000000196_thumb.jpg","0000000195_thumb.jpg"],
    "340": ["0000000015_thumb.jpg","0000000014_thumb.jpg","0000000013_thumb.jpg","0000000011_thumb.jpg","0000000010_thumb.jpg"],
    "130": ["0000000131_thumb.jpg","0000000130_thumb.jpg","0000000129_thumb.jpg","0000000128_thumb.jpg","0000000127_thumb.jpg"],
    "280": ["0000000190_thumb.jpg","0000000189_thumb.jpg","0000000188_thumb.jpg","0000000187_thumb.jpg"],
    "90025": ["0000000226_thumb.jpg","0000000225_thumb.jpg","0000000224_thumb.jpg","0000000223_thumb.jpg","0000000222_thumb.jpg"],
    "90015": ["0000000093_thumb.jpg","0000000092_thumb.jpg","0000000091_thumb.jpg","0000000090_thumb.jpg","0000000089_thumb.jpg"],
    "90007": ["0000000068_thumb.jpg","0000000067_thumb.jpg","0000000066_thumb.jpg","0000000065_thumb.jpg","0000000064_thumb.jpg"],
    "90000": ["0000000048_thumb.jpg","0000000047_thumb.jpg","0000000046_thumb.jpg"],
    "90002": ["0000000211_thumb.jpg","0000000210_thumb.jpg","0000000202_thumb.jpg","0000000201_thumb.jpg","0000000200_thumb.jpg"],
    "50": ["0000000159_thumb.jpg","0000000158_thumb.jpg","0000000157_thumb.jpg","0000000156_thumb.jpg","0000000155_thumb.jpg"],
    "90011": ["0000000083_thumb.jpg","0000000082_thumb.jpg","0000000081_thumb.jpg","0000000080_thumb.jpg","0000000079_thumb.jpg"],
    "1002": ["0000000209_thumb.jpg","0000000208_thumb.jpg","0000000207_thumb.jpg","0000000206_thumb.jpg","0000000205_thumb.jpg"],
    "60": ["0000000163_thumb.jpg","0000000162_thumb.jpg","0000000161_thumb.jpg","0000000160_thumb.jpg"],
    "90017": ["0000000098_thumb.jpg","0000000097_thumb.jpg","0000000096_thumb.jpg","0000000095_thumb.jpg","0000000094_thumb.jpg"],
    "1610": ["0000000247_thumb.jpg","0000000246_thumb.jpg","0000000245_thumb.jpg","0000000243_thumb.jpg","0000000242_thumb.jpg"],
    "90005": ["0000000058_thumb.jpg","0000000057_thumb.jpg","0000000056_thumb.jpg","0000000055_thumb.jpg","0000000054_thumb.jpg"],
    "20": ["0000000168_thumb.jpg","0000000167_thumb.jpg","0000000166_thumb.jpg","0000000165_thumb.jpg","0000000164_thumb.jpg"],
    "90008": ["0000000073_thumb.jpg","0000000072_thumb.jpg","0000000071_thumb.jpg","0000000070_thumb.jpg","0000000069_thumb.jpg"],
    "90022": ["0000000113_thumb.jpg","0000000112_thumb.jpg","0000000111_thumb.jpg","0000000110_thumb.jpg","0000000109_thumb.jpg"],
    "90004": ["0000000053_thumb.jpg","0000000052_thumb.jpg","0000000051_thumb.jpg","0000000050_thumb.jpg","0000000049_thumb.jpg"],
    "90018": ["0000000186_thumb.jpg","0000000185_thumb.jpg","0000000184_thumb.jpg","0000000183_thumb.jpg","0000000182_thumb.jpg"],
    "90020": ["0000000181_thumb.jpg","0000000180_thumb.jpg","0000000179_thumb.jpg"],
    "90012": ["0000000036_thumb.jpg","0000000035_thumb.jpg","0000000034_thumb.jpg","0000000033_thumb.jpg","0000000032_thumb.jpg"]
}

def organize_screenshots(app_images):
    """Create per-appid folders/screenshots and move files, including non-thumb variants."""
    for appid, images in app_images.items():
        if not images:
            continue

        app_folder = os.path.join(DEST_BASE, appid)
        screenshots_folder = os.path.join(app_folder, "screenshots")

        os.makedirs(screenshots_folder, exist_ok=True)

        for img in images:
            # Move thumb
            src = os.path.join(SOURCE_SCREENSHOTS, img)
            dst = os.path.join(screenshots_folder, img)
            if os.path.exists(src):
                shutil.move(src, dst)
                print(f"Moved {img} -> {screenshots_folder}")

            # Move non-thumb (remove "_thumb")
            base, ext = os.path.splitext(img)
            if base.endswith("_thumb"):
                full_img = base.replace("_thumb", "") + ext
                src_full = os.path.join(SOURCE_SCREENSHOTS, full_img)
                dst_full = os.path.join(screenshots_folder, full_img)
                if os.path.exists(src_full):
                    shutil.move(src_full, dst_full)
                    print(f"Moved {full_img} -> {screenshots_folder}")

if __name__ == "__main__":
    organize_screenshots(app_images)
