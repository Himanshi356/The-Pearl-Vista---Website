# Merge Changes Viewing Guide

## 🔍 How to View Merge Changes Simultaneously

This guide shows you multiple ways to view and compare your original files with your partner's changes side by side.

## 📋 Available Tools

### 1. Web-Based Side-by-Side Viewer
**File**: `merge-viewer.html`

**How to use**:
1. Open `merge-viewer.html` in your browser
2. Upload your partner's files by dragging and dropping
3. Select files from the dropdown to compare
4. View differences side by side with synchronized scrolling

**Features**:
- ✅ Side-by-side file comparison
- ✅ Line numbers
- ✅ Synchronized scrolling
- ✅ File upload support
- ✅ Visual diff highlighting

### 2. Command-Line Merge Viewer
**File**: `merge-viewer.js`

**How to use**:
```bash
# Basic comparison
node merge-viewer.js styles.css partner-styles.css

# Interactive mode
node merge-viewer.js main.js partner-main.js --interactive

# Compare multiple files
node merge-viewer.js index.html partner-index.html
```

**Features**:
- ✅ Terminal-based comparison
- ✅ Color-coded differences
- ✅ Interactive merge mode
- ✅ Summary statistics
- ✅ Recommendations

### 3. Git Diff Tools
**Built-in Git commands**:

```bash
# View differences between files
git diff original-file partner-file

# View differences with side-by-side output
git diff --side-by-side original-file partner-file

# View differences with word-level changes
git diff --word-diff original-file partner-file

# View differences in a GUI (if available)
git difftool original-file partner-file
```

### 4. External Diff Tools

#### VS Code
1. Open both files in VS Code
2. Right-click on one file → "Compare Active File with Selected"
3. View differences side by side

#### Beyond Compare
1. Install Beyond Compare
2. Open both files
3. View synchronized side-by-side comparison

#### WinMerge (Windows)
1. Install WinMerge
2. Open both files
3. View differences with highlighting

## 🎯 Step-by-Step Process

### Step 1: Prepare Your Files
```bash
# Create a directory for partner files
mkdir partner-files

# Copy your partner's files there
cp /path/to/partner/files/* partner-files/
```

### Step 2: Choose Your Viewing Method

#### Option A: Web Viewer (Recommended for beginners)
1. Open `merge-viewer.html` in browser
2. Drag and drop partner files
3. Select files to compare
4. Review differences visually

#### Option B: Command Line (For advanced users)
```bash
# Compare specific files
node merge-viewer.js styles.css partner-files/styles.css

# Compare with interactive mode
node merge-viewer.js main.js partner-files/main.js --interactive
```

#### Option C: Git Tools (For Git users)
```bash
# Create temporary files for comparison
cp styles.css styles-original.css
cp partner-files/styles.css styles-partner.css

# Compare with Git
git diff --side-by-side styles-original.css styles-partner.css
```

### Step 3: Analyze Differences

#### What to Look For:

**HTML Files**:
- ✅ New content sections
- ✅ Modified navigation
- ✅ Changed structure
- ⚠️ Removed content
- ❌ Complete file replacements

**CSS Files**:
- ✅ New styles at the end
- ✅ New selectors
- ⚠️ Modified existing selectors
- ❌ Complete file replacements

**JavaScript Files**:
- ✅ New functions
- ✅ New event handlers
- ⚠️ Modified existing functions
- ❌ Complete file replacements

**PHP Files**:
- ✅ New functions
- ✅ New database queries
- ⚠️ Modified existing logic
- ❌ Database structure changes

### Step 4: Make Merge Decisions

#### Safe to Merge:
- ✅ New files
- ✅ New CSS styles (at the end)
- ✅ New JavaScript functions
- ✅ New HTML content sections

#### Needs Review:
- ⚠️ Modified existing functions
- ⚠️ Changed CSS selectors
- ⚠️ Modified HTML structure
- ⚠️ Changed PHP logic

#### Avoid:
- ❌ Complete file replacements
- ❌ Database structure changes
- ❌ Core functionality changes

## 🛠️ Advanced Viewing Techniques

### 1. Three-Way Comparison
Compare your original, your current, and partner's version:

```bash
# Create three versions
cp styles.css styles-original.css
cp styles.css styles-current.css
cp partner-files/styles.css styles-partner.css

# Use a three-way diff tool
# (Requires specialized diff tools)
```

### 2. Section-by-Section Comparison
For large files, compare specific sections:

```bash
# Extract specific sections
grep -A 10 -B 5 "function init" main.js > main-init-section.txt
grep -A 10 -B 5 "function init" partner-files/main.js > partner-init-section.txt

# Compare sections
node merge-viewer.js main-init-section.txt partner-init-section.txt
```

### 3. Visual Diff with Screenshots
1. Take screenshots of your current pages
2. Apply partner's changes
3. Take screenshots again
4. Compare visually

## 📊 Understanding the Output

### Web Viewer Output:
- **Left Panel**: Your original file
- **Right Panel**: Partner's file
- **Highlighted Lines**: Differences
- **Line Numbers**: For easy reference

### Command Line Output:
```
Line │ Original Content          │ Partner Content
-----│--------------------------│--------------------------
  1  │ body {                  │ body {
  2  │   font-family: Arial;   │   font-family: 'Segoe UI';
  3  │   margin: 0;            │   margin: 0;
  4  │   padding: 0;           │   padding: 0;
  5  │ }                       │   background: #f5f5f5;
  6  │                         │ }
```

### Color Coding:
- 🟢 **Green**: Added content
- 🔴 **Red**: Removed content
- 🟡 **Yellow**: Modified content
- ⚪ **White**: Unchanged content

## 🔧 Troubleshooting

### Common Issues:

**Problem**: Files not loading in web viewer
**Solution**: Check file permissions and browser console

**Problem**: Command line tool not working
**Solution**: Ensure Node.js is installed and files exist

**Problem**: Git diff not showing differences
**Solution**: Ensure files are different and Git is configured

**Problem**: Large files causing performance issues
**Solution**: Use section-by-section comparison

## 📈 Best Practices

### 1. Start Small
- Compare one file at a time
- Focus on the most important files first
- Test after each merge

### 2. Use Multiple Tools
- Web viewer for visual comparison
- Command line for detailed analysis
- Git tools for version control

### 3. Document Changes
- Keep notes of what you merge
- Record any issues encountered
- Document decisions made

### 4. Test Frequently
- Test functionality after each merge
- Check for broken links or styles
- Verify database connections

## 🚀 Quick Start Commands

```bash
# 1. Open web viewer
start merge-viewer.html

# 2. Compare specific files
node merge-viewer.js styles.css partner-files/styles.css

# 3. Interactive merge
node merge-viewer.js main.js partner-files/main.js --interactive

# 4. Git comparison
git diff --side-by-side styles.css partner-files/styles.css
```

## 📞 Need Help?

1. **Web Viewer Issues**: Check browser console for errors
2. **Command Line Issues**: Ensure Node.js is installed
3. **Git Issues**: Check Git configuration
4. **File Issues**: Verify file paths and permissions

---

**Remember**: Take your time to understand the differences before merging! 🐢 