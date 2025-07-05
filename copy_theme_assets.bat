@echo off
REM Copy archived theme assets into working theme directories
setlocal
set ROOT=%~dp0

xcopy /E /Y "%ROOT%archived_steampowered\2005\v1\img" "%ROOT%themes\2005_v1\img"
xcopy /Y "%ROOT%archived_steampowered\2005\v1\steampowered02.css" "%ROOT%themes\2005_v1\steampowered02.css"
xcopy /E /Y "%ROOT%archived_steampowered\2005\v2\img" "%ROOT%themes\2005_v2\img"
xcopy /Y "%ROOT%archived_steampowered\2005\v2\steampowered03.css" "%ROOT%themes\2005_v2\steampowered03.css"

echo Assets copied.
