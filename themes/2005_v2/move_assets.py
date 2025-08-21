#!/usr/bin/env python3
import os
import shutil
import re

def copy_file_if_exists(src, dst):
    """Copy file from src to dst if src exists"""
    if os.path.exists(src):
        os.makedirs(os.path.dirname(dst), exist_ok=True)
        shutil.copy2(src, dst)
        print(f"Copied: {src} -> {dst}")
        return True
    else:
        print(f"Source not found: {src}")
        return False

def main():
    script_dir = os.path.dirname(os.path.abspath(__file__))
    theme_dir = script_dir
    root_dir = os.path.abspath(os.path.join(script_dir, '..', '..'))
    archived_dir = os.path.join(root_dir, 'archived_steampowered', '2005')
    
    print(f"Theme directory: {theme_dir}")
    print(f"Archived directory: {archived_dir}")
    
    # Copy main 2005_v2 CSS files
    copy_file_if_exists(
        os.path.join(archived_dir, 'v2', 'steampowered03.css'),
        os.path.join(theme_dir, 'css', 'steampowered03.css')
    )
    
    # Copy navigation JavaScript
    copy_file_if_exists(
        os.path.join(archived_dir, 'v2', 'nav.js'),
        os.path.join(theme_dir, 'js', 'nav.js')
    )
    
    # Copy storefront assets
    storefront_src = os.path.join(archived_dir, 'storefront')
    storefront_dst = os.path.join(theme_dir, 'storefront')
    
    # Copy storefront CSS
    copy_file_if_exists(
        os.path.join(storefront_src, 'storefront.css'),
        os.path.join(storefront_dst, 'css', 'storefront.css')
    )
    
    # Copy storefront JavaScript
    copy_file_if_exists(
        os.path.join(storefront_src, 'javascript.js'),
        os.path.join(storefront_dst, 'js', 'javascript.js')
    )
    
    copy_file_if_exists(
        os.path.join(storefront_src, 'pop.js'),
        os.path.join(storefront_dst, 'js', 'pop.js')
    )
    
    # Copy storefront images from archived folder
    storefront_img_src = os.path.join(storefront_src, 'img')
    storefront_img_dst = os.path.join(storefront_dst, 'images', 'img')
    
    if os.path.exists(storefront_img_src):
        for item in os.listdir(storefront_img_src):
            src_path = os.path.join(storefront_img_src, item)
            dst_path = os.path.join(storefront_img_dst, item)
            if os.path.isfile(src_path):
                copy_file_if_exists(src_path, dst_path)
    
    # Copy gfx directory
    gfx_src = os.path.join(storefront_src, 'gfx')
    gfx_dst = os.path.join(storefront_dst, 'images', 'gfx')
    
    if os.path.exists(gfx_src):
        for item in os.listdir(gfx_src):
            src_path = os.path.join(gfx_src, item)
            dst_path = os.path.join(gfx_dst, item)
            if os.path.isfile(src_path):
                copy_file_if_exists(src_path, dst_path)
    
    # Copy storefront image directory
    images_src = os.path.join(storefront_src, 'images')
    images_dst = os.path.join(storefront_dst, 'images')
    
    if os.path.exists(images_src):
        for item in os.listdir(images_src):
            src_path = os.path.join(images_src, item)
            dst_path = os.path.join(images_dst, item)
            if os.path.isfile(src_path):
                copy_file_if_exists(src_path, dst_path)
    
    print("Asset copy completed for 2005_v2 theme")

if __name__ == "__main__":
    main()
