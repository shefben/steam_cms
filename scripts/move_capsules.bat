@echo off
REM Move storefront capsule images from archive to storefront/images
setlocal EnableDelayedExpansion
set ROOT=..\
set SRC=%ROOT%archived_steampowered\2005\storefront\capsules\img
set DEST=%ROOT%storefront\images\capsules

for /d %%F in ("%SRC%\*") do (
    set "FOLDER=%%~nF"
    for /f "tokens=1,2 delims=_" %%a in ("!FOLDER!") do (
        set "YEAR=%%a"
        set "MONTH=%%b"
    )
    set "DATE=!MONTH!_01_!YEAR!.png"
    for %%P in (top middle bottom_right bottom_left) do (
        if exist "%%F\%%P_capsule.png" (
            if not exist "!DEST!\%%P" mkdir "!DEST!\%%P"
            copy /Y "%%F\%%P_capsule.png" "!DEST!\%%P\!DATE!" >nul
        )
    )
)

echo Capsules moved.
