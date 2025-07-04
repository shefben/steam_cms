@echo off
REM Move storefront capsule images from archive to storefront/images
setlocal
set ROOT=%~dp0
if not exist "%ROOT%storefront\images\capsules" (
    mkdir "%ROOT%storefront\images\capsules"
)
xcopy /E /Y "%ROOT%archived_steampowered\2006\store\capsules\img" "%ROOT%storefront\images\capsules" >nul
xcopy /E /Y "%ROOT%archived_steampowered\2006\store\index\v2\capsules\img" "%ROOT%storefront\images\capsules" >nul
echo Capsules moved.
