@echo off
REM Move storefront capsule folders to images directory
set SRC=%~dp0..\archived_steampowered\2005\storefront\capsules\img
set DEST=%~dp0..\storefront\images\capsules
if not exist "%DEST%" mkdir "%DEST%"
for /D %%F in ("%SRC%\*") do (
  move "%%F" "%DEST%" >nul
)
