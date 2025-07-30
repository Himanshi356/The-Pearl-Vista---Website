/**
 * Merge Helper Script
 * Assists with safe merging of partner changes
 */

class MergeHelper {
    constructor() {
        this.backupFiles = new Set();
        this.modifiedFiles = new Set();
        this.conflicts = [];
    }

    /**
     * Compare two HTML files and identify differences
     */
    compareHTMLFiles(originalFile, partnerFile) {
        const differences = {
            structure: [],
            content: [],
            styles: [],
            scripts: []
        };

        // This would be implemented based on your specific needs
        console.log(`Comparing ${originalFile} with ${partnerFile}`);
        
        return differences;
    }

    /**
     * Safely merge CSS files by appending new styles
     */
    mergeCSSFiles(originalCSS, partnerCSS) {
        const originalSelectors = this.extractSelectors(originalCSS);
        const partnerSelectors = this.extractSelectors(partnerCSS);
        
        const newSelectors = partnerSelectors.filter(selector => 
            !originalSelectors.includes(selector)
        );

        return {
            safeToAdd: newSelectors,
            conflicts: partnerSelectors.filter(selector => 
                originalSelectors.includes(selector)
            )
        };
    }

    /**
     * Extract CSS selectors from CSS content
     */
    extractSelectors(cssContent) {
        const selectorRegex = /([^{}]+)\s*{/g;
        const selectors = [];
        let match;

        while ((match = selectorRegex.exec(cssContent)) !== null) {
            selectors.push(match[1].trim());
        }

        return selectors;
    }

    /**
     * Compare JavaScript files for function conflicts
     */
    compareJSFiles(originalJS, partnerJS) {
        const originalFunctions = this.extractFunctions(originalJS);
        const partnerFunctions = this.extractFunctions(partnerJS);
        
        return {
            safeToAdd: partnerFunctions.filter(func => 
                !originalFunctions.includes(func.name)
            ),
            conflicts: partnerFunctions.filter(func => 
                originalFunctions.some(origFunc => origFunc.name === func.name)
            )
        };
    }

    /**
     * Extract function names from JavaScript content
     */
    extractFunctions(jsContent) {
        const functionRegex = /(?:function\s+(\w+)|(\w+)\s*[:=]\s*function|(\w+)\s*[:=]\s*\([^)]*\)\s*=>)/g;
        const functions = [];
        let match;

        while ((match = functionRegex.exec(jsContent)) !== null) {
            const functionName = match[1] || match[2] || match[3];
            if (functionName) {
                functions.push({ name: functionName, line: match.index });
            }
        }

        return functions;
    }

    /**
     * Generate a merge report
     */
    generateMergeReport(originalFiles, partnerFiles) {
        const report = {
            safeToMerge: [],
            needsReview: [],
            conflicts: [],
            recommendations: []
        };

        // Analyze each file type
        for (const file of partnerFiles) {
            const originalFile = originalFiles.find(f => f.name === file.name);
            
            if (!originalFile) {
                report.safeToMerge.push({
                    file: file.name,
                    reason: 'New file - safe to add'
                });
                continue;
            }

            if (file.name.endsWith('.css')) {
                const cssAnalysis = this.mergeCSSFiles(originalFile.content, file.content);
                if (cssAnalysis.conflicts.length > 0) {
                    report.conflicts.push({
                        file: file.name,
                        type: 'CSS conflicts',
                        details: cssAnalysis.conflicts
                    });
                } else {
                    report.safeToMerge.push({
                        file: file.name,
                        reason: 'CSS - new selectors only'
                    });
                }
            } else if (file.name.endsWith('.js')) {
                const jsAnalysis = this.compareJSFiles(originalFile.content, file.content);
                if (jsAnalysis.conflicts.length > 0) {
                    report.needsReview.push({
                        file: file.name,
                        type: 'JavaScript function conflicts',
                        details: jsAnalysis.conflicts
                    });
                } else {
                    report.safeToMerge.push({
                        file: file.name,
                        reason: 'JavaScript - new functions only'
                    });
                }
            } else if (file.name.endsWith('.html')) {
                report.needsReview.push({
                    file: file.name,
                    type: 'HTML - manual review required',
                    reason: 'HTML files need manual section-by-section comparison'
                });
            }
        }

        return report;
    }

    /**
     * Create a backup of current files
     */
    backupCurrentFiles(fileList) {
        const backup = {
            timestamp: new Date().toISOString(),
            files: fileList.map(file => ({
                name: file.name,
                content: file.content,
                hash: this.generateHash(file.content)
            }))
        };

        localStorage.setItem('mergeBackup', JSON.stringify(backup));
        return backup;
    }

    /**
     * Generate a simple hash for content
     */
    generateHash(content) {
        let hash = 0;
        for (let i = 0; i < content.length; i++) {
            const char = content.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash; // Convert to 32-bit integer
        }
        return hash.toString();
    }

    /**
     * Validate merge safety
     */
    validateMergeSafety(originalFiles, partnerFiles) {
        const criticalFiles = ['styles.css', 'main.js', 'index.html'];
        const warnings = [];

        for (const criticalFile of criticalFiles) {
            const originalFile = originalFiles.find(f => f.name === criticalFile);
            const partnerFile = partnerFiles.find(f => f.name === criticalFile);

            if (originalFile && partnerFile) {
                const originalHash = this.generateHash(originalFile.content);
                const partnerHash = this.generateHash(partnerFile.content);

                if (originalHash !== partnerHash) {
                    warnings.push({
                        file: criticalFile,
                        type: 'Critical file modified',
                        recommendation: 'Manual review required'
                    });
                }
            }
        }

        return {
            safe: warnings.length === 0,
            warnings: warnings
        };
    }
}

// Export for use in browser or Node.js
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MergeHelper;
} else {
    window.MergeHelper = MergeHelper;
}

// Usage example:
/*
const helper = new MergeHelper();

// Backup current files
const backup = helper.backupCurrentFiles(currentFiles);

// Generate merge report
const report = helper.generateMergeReport(originalFiles, partnerFiles);

// Validate safety
const safety = helper.validateMergeSafety(originalFiles, partnerFiles);

console.log('Merge Report:', report);
console.log('Safety Check:', safety);
*/ 