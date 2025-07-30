@echo off
title Merge File Comparison Tool

echo.
echo ========================================
echo    Merge File Comparison Tool
echo ========================================
echo.

:menu
echo Choose an option:
echo.
echo 1. Open Web Viewer (Recommended)
echo 2. Compare files with Git
echo 3. Create partner files directory
echo 4. View current status
echo 5. Exit
echo.
set /p choice="Enter your choice (1-5): "

if "%choice%"=="1" goto web_viewer
if "%choice%"=="2" goto git_compare
if "%choice%"=="3" goto create_directory
if "%choice%"=="4" goto view_status
if "%choice%"=="5" goto exit
goto menu

:web_viewer
echo.
echo Opening web viewer...
echo Please wait...
start "" "merge-viewer.html"
echo.
echo Web viewer opened! You can now:
echo - Drag and drop partner files
echo - Select files to compare
echo - View differences side by side
echo.
pause
goto menu

:git_compare
echo.
echo Git File Comparison
echo ===================
echo.
set /p file1="Enter original file path: "
set /p file2="Enter partner file path: "

if not exist "%file1%" (
    echo Error: Original file not found!
    pause
    goto menu
)

if not exist "%file2%" (
    echo Error: Partner file not found!
    pause
    goto menu
)

echo.
echo Comparing files with Git...
echo.
git diff --side-by-side "%file1%" "%file2%"
echo.
pause
goto menu

:create_directory
echo.
echo Creating partner files directory...
if not exist "partner-files" (
    mkdir partner-files
    echo Created 'partner-files' directory
) else (
    echo 'partner-files' directory already exists
)
echo.
echo You can now copy your partner's files to this directory
echo and use the web viewer to compare them.
echo.
pause
goto menu

:view_status
echo.
echo Current Git Status:
echo ===================
git status
echo.
echo Current Branch:
git branch
echo.
echo Recent Commits:
git log --oneline -5
echo.
pause
goto menu

:exit
echo.
echo Thank you for using the Merge File Comparison Tool!
echo.
exit 