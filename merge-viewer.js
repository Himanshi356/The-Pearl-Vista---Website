#!/usr/bin/env node

/**
 * Command-line merge viewer for comparing files
 * Usage: node merge-viewer.js <original-file> <partner-file>
 */

const fs = require('fs');
const path = require('path');
const readline = require('readline');

class MergeViewer {
    constructor() {
        this.originalFile = '';
        this.partnerFile = '';
        this.originalContent = '';
        this.partnerContent = '';
    }

    /**
     * Load and compare two files
     */
    async compareFiles(originalPath, partnerPath) {
        try {
            this.originalFile = originalPath;
            this.partnerFile = partnerPath;

            // Load file contents
            this.originalContent = fs.readFileSync(originalPath, 'utf8');
            this.partnerContent = fs.readFileSync(partnerPath, 'utf8');

            console.log('\n🔀 Side-by-Side File Comparison');
            console.log('=' .repeat(80));
            console.log(`📄 Original: ${originalPath}`);
            console.log(`🔄 Partner:  ${partnerPath}`);
            console.log('=' .repeat(80));

            this.displaySideBySide();
            this.showSummary();

        } catch (error) {
            console.error('❌ Error loading files:', error.message);
            process.exit(1);
        }
    }

    /**
     * Display files side by side
     */
    displaySideBySide() {
        const originalLines = this.originalContent.split('\n');
        const partnerLines = this.partnerContent.split('\n');
        const maxLines = Math.max(originalLines.length, partnerLines.length);

        console.log('\n📋 Line-by-Line Comparison:');
        console.log('-'.repeat(80));

        for (let i = 0; i < maxLines; i++) {
            const originalLine = originalLines[i] || '';
            const partnerLine = partnerLines[i] || '';
            const lineNum = (i + 1).toString().padStart(3, ' ');

            if (originalLine === partnerLine) {
                // Same line
                console.log(`${lineNum} │ ${this.truncateLine(originalLine, 35)} │ ${this.truncateLine(partnerLine, 35)}`);
            } else {
                // Different line - highlight
                const originalDisplay = this.truncateLine(originalLine, 35);
                const partnerDisplay = this.truncateLine(partnerLine, 35);
                
                if (originalLine && partnerLine) {
                    // Modified line
                    console.log(`${lineNum} │ \x1b[33m${originalDisplay}\x1b[0m │ \x1b[33m${partnerDisplay}\x1b[0m`);
                } else if (originalLine) {
                    // Removed line
                    console.log(`${lineNum} │ \x1b[31m${originalDisplay}\x1b[0m │ \x1b[31m<removed>\x1b[0m`);
                } else {
                    // Added line
                    console.log(`${lineNum} │ \x1b[31m<added>\x1b[0m │ \x1b[32m${partnerDisplay}\x1b[0m`);
                }
            }
        }
    }

    /**
     * Show summary of differences
     */
    showSummary() {
        const originalLines = this.originalContent.split('\n');
        const partnerLines = this.partnerContent.split('\n');
        
        let added = 0;
        let removed = 0;
        let modified = 0;

        const maxLines = Math.max(originalLines.length, partnerLines.length);
        
        for (let i = 0; i < maxLines; i++) {
            const originalLine = originalLines[i] || '';
            const partnerLine = partnerLines[i] || '';

            if (originalLine !== partnerLine) {
                if (originalLine && partnerLine) {
                    modified++;
                } else if (originalLine) {
                    removed++;
                } else {
                    added++;
                }
            }
        }

        console.log('\n📊 Summary:');
        console.log('-'.repeat(40));
        console.log(`📈 Lines added:    ${added}`);
        console.log(`📉 Lines removed:  ${removed}`);
        console.log(`🔄 Lines modified: ${modified}`);
        console.log(`📄 Total lines:    ${maxLines}`);
        
        const changePercentage = ((added + removed + modified) / maxLines * 100).toFixed(1);
        console.log(`📊 Change rate:    ${changePercentage}%`);
    }

    /**
     * Truncate line for display
     */
    truncateLine(line, maxLength) {
        if (line.length <= maxLength) {
            return line.padEnd(maxLength, ' ');
        }
        return line.substring(0, maxLength - 3) + '...';
    }

    /**
     * Generate diff report
     */
    generateDiffReport() {
        const originalLines = this.originalContent.split('\n');
        const partnerLines = this.partnerContent.split('\n');
        
        const report = {
            fileName: path.basename(this.originalFile),
            originalLines: originalLines.length,
            partnerLines: partnerLines.length,
            differences: [],
            recommendations: []
        };

        let lineNum = 1;
        for (let i = 0; i < Math.max(originalLines.length, partnerLines.length); i++) {
            const originalLine = originalLines[i] || '';
            const partnerLine = partnerLines[i] || '';

            if (originalLine !== partnerLine) {
                report.differences.push({
                    line: lineNum,
                    original: originalLine,
                    partner: partnerLine,
                    type: originalLine && partnerLine ? 'modified' : originalLine ? 'removed' : 'added'
                });
            }
            lineNum++;
        }

        // Generate recommendations
        if (report.differences.length > 0) {
            const modifiedCount = report.differences.filter(d => d.type === 'modified').length;
            const addedCount = report.differences.filter(d => d.type === 'added').length;
            const removedCount = report.differences.filter(d => d.type === 'removed').length;

            if (modifiedCount > 0) {
                report.recommendations.push('⚠️  Review modified lines carefully');
            }
            if (addedCount > 0) {
                report.recommendations.push('✅ New content can be safely added');
            }
            if (removedCount > 0) {
                report.recommendations.push('❌ Review removed content - may break functionality');
            }
        }

        return report;
    }

    /**
     * Interactive merge mode
     */
    async interactiveMerge() {
        const report = this.generateDiffReport();
        
        console.log('\n🎯 Interactive Merge Mode');
        console.log('=' .repeat(50));
        
        for (const diff of report.differences) {
            console.log(`\n📝 Line ${diff.line}:`);
            console.log(`   Original: ${diff.original}`);
            console.log(`   Partner:  ${diff.partner}`);
            console.log(`   Type:     ${diff.type}`);
            
            const answer = await this.askQuestion('Accept this change? (y/n/s=skip): ');
            
            switch (answer.toLowerCase()) {
                case 'y':
                    console.log('✅ Accepted');
                    break;
                case 'n':
                    console.log('❌ Rejected');
                    break;
                case 's':
                    console.log('⏭️  Skipped');
                    break;
                default:
                    console.log('⏭️  Skipped (invalid input)');
            }
        }
    }

    /**
     * Ask user a question
     */
    askQuestion(question) {
        const rl = readline.createInterface({
            input: process.stdin,
            output: process.stdout
        });

        return new Promise((resolve) => {
            rl.question(question, (answer) => {
                rl.close();
                resolve(answer);
            });
        });
    }
}

// Command line interface
async function main() {
    const args = process.argv.slice(2);
    
    if (args.length < 2) {
        console.log('Usage: node merge-viewer.js <original-file> <partner-file> [--interactive]');
        console.log('');
        console.log('Options:');
        console.log('  --interactive    Enable interactive merge mode');
        console.log('');
        console.log('Examples:');
        console.log('  node merge-viewer.js styles.css partner-styles.css');
        console.log('  node merge-viewer.js main.js partner-main.js --interactive');
        process.exit(1);
    }

    const originalFile = args[0];
    const partnerFile = args[1];
    const interactive = args.includes('--interactive');

    const viewer = new MergeViewer();
    
    try {
        await viewer.compareFiles(originalFile, partnerFile);
        
        if (interactive) {
            await viewer.interactiveMerge();
        }
        
        const report = viewer.generateDiffReport();
        
        console.log('\n📋 Recommendations:');
        report.recommendations.forEach(rec => {
            console.log(`   ${rec}`);
        });
        
    } catch (error) {
        console.error('❌ Error:', error.message);
        process.exit(1);
    }
}

// Run if called directly
if (require.main === module) {
    main();
}

module.exports = MergeViewer; 