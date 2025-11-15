@echo off
setlocal EnableDelayedExpansion

:: Set the threshold (260 characters is the default max path for Windows Git)
set "MAXLEN=260"

:: Create the git_unfriendly folder if it doesn't exist
if not exist "git_unfriendly" (
    mkdir "git_unfriendly"
)

:: Get current directory so we can calculate relative paths
set "BASEDIR=%cd%"

:: Loop through all files recursively
for /r %%F in (*) do (
    set "FULL=%%F"
    setlocal enabledelayedexpansion
    set "LEN=0"
    set "STR=!FULL!"
    call :strlen "!STR!" LEN
    if !LEN! GTR %MAXLEN% (
        echo [LONG] !STR!
        move "%%F" "%BASEDIR%\git_unfriendly\" >nul
    )
    endlocal
)

echo Done.
goto :eof

:strlen
:: Calculates length of input string and sets the result in variable name passed
setlocal EnableDelayedExpansion
set "s=%~1"
set "len=0"
:strlen_loop
if defined s (
    set "s=!s:~1!"
    set /a len+=1
    goto strlen_loop
)
endlocal & set "%2=%len%"
goto :eof