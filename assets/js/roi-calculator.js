// roi-calculator.js - Interactive Business Value Calculator

document.addEventListener("DOMContentLoaded", () => {
    // 1. Capture Calculator Inputs
    const companySizeInput = document.getElementById("company_size");
    const manualWorkflowsInput = document.getElementById("manual_workflows");
    const operationalCostInput = document.getElementById("operational_cost");
    const infraSpendInput = document.getElementById("infra_spend");

    // Capture Slider Visual Counters
    const sizeVal = document.getElementById("size_val");
    const manualVal = document.getElementById("manual_val");
    const costVal = document.getElementById("cost_val");
    const infraVal = document.getElementById("infra_val");

    // Capture Calculator Outputs
    const outSavings = document.getElementById("out_savings");
    const outEfficiency = document.getElementById("out_efficiency");
    const outRoi = document.getElementById("out_roi");
    const outTimeline = document.getElementById("out_timeline");

    // Hidden Inputs for Lead Capture Form submission
    const calcSavingsField = document.getElementById("calc_savings");
    const calcRoiField = document.getElementById("calc_roi");

    if (!companySizeInput || !manualWorkflowsInput) return; // Only execute if calculator matches

    // Helper: Format Currency
    const formatCurrency = (value) => {
        if (value >= 1000000) {
            return "$" + (value / 1000000).toFixed(1) + "M";
        }
        return "$" + (value / 1000).toFixed(0) + "k";
    };

    // 2. Perform ROI Math Calculations
    const recalculateROI = () => {
        const size = parseInt(companySizeInput.value) || 50;
        const manualPct = parseInt(manualWorkflowsInput.value) || 20;
        const opCost = parseFloat(operationalCostInput.value) || 100000;
        const infraSpend = parseFloat(infraSpendInput.value) || 50000;

        // Update Slider indicator values
        if (sizeVal) sizeVal.textContent = size.toLocaleString() + " FTEs";
        if (manualVal) manualVal.textContent = manualPct + "%";
        if (costVal) costVal.textContent = formatCurrency(opCost);
        if (infraVal) infraVal.textContent = formatCurrency(infraSpend);

        // Savings Algorithm:
        // Automation saves up to 45% of manual operational costs.
        const automationSaving = (opCost * (manualPct / 100)) * 0.45;
        // Cloud transformation cuts infra spend by 30%.
        const infraSaving = infraSpend * 0.30;
        
        const totalAnnualSavings = automationSaving + infraSaving;
        
        // Efficiency gains: workflow multiplier (max 4.2x)
        const efficiencyFactor = 1.0 + (manualPct / 100) * 3.2;

        // ROI percentage projection
        // We assume Sisgain integration costs 1.5 months of operational cost as a one-time project fee
        const estimatedProjectCost = Math.max(opCost * 0.15, 25000);
        const netThreeYearSavings = (totalAnnualSavings * 3) - estimatedProjectCost;
        const roiPercentage = (netThreeYearSavings / estimatedProjectCost) * 100;

        // Display results dynamically
        if (outSavings) {
            animateNumberText(outSavings, totalAnnualSavings, "$", "/yr");
        }
        if (outEfficiency) {
            animateNumberText(outEfficiency, efficiencyFactor, "", "x Faster", true);
        }
        if (outRoi) {
            animateNumberText(outRoi, Math.max(0, roiPercentage), "", "%", false);
        }
        if (outTimeline) {
            const time = 12 - (manualPct * 0.08); // high manual workflow = faster ROI pay-off
            outTimeline.textContent = Math.max(3, Math.round(time)) + " Months";
        }

        // Keep hidden fields synced for lead database storage
        if (calcSavingsField) calcSavingsField.value = totalAnnualSavings.toFixed(2);
        if (calcRoiField) calcRoiField.value = Math.max(0, roiPercentage).toFixed(2);
    };

    // Number Counter Animation Helper
    const animateNumberText = (element, targetValue, prefix = "", suffix = "", isFloat = false) => {
        let start = 0;
        const duration = 500;
        const startTime = performance.now();

        const update = (now) => {
            const progress = Math.min((now - startTime) / duration, 1);
            const current = progress * targetValue;
            
            if (isFloat) {
                element.textContent = prefix + current.toFixed(1) + suffix;
            } else {
                element.textContent = prefix + Math.floor(current).toLocaleString() + suffix;
            }

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        };
        requestAnimationFrame(update);
    };

    // 3. Listen for inputs
    const inputs = [companySizeInput, manualWorkflowsInput, operationalCostInput, infraSpendInput];
    inputs.forEach(input => {
        input.addEventListener("input", recalculateROI);
    });

    // Initial recalculation
    recalculateROI();
});
