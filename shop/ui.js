
//  Script.js 
const rangevalue =  
    document.querySelector(".slider-container .price-slider"); 
const rangeInputvalue =  
    document.querySelectorAll(".range-input input"); 
  
// Set the price gap 
let priceGap = 500; 
  
// Adding event listners to price input elements 
const priceInputvalue =  
    document.querySelectorAll(".price-input input"); 
for (let i = 0; i < priceInputvalue.length; i++) { 
    priceInputvalue[i].addEventListener("input", e => { 
  
        // Parse min and max values of the range input 
        let minp = parseInt(priceInputvalue[0].value); 
        let maxp = parseInt(priceInputvalue[1].value); 
        let diff = maxp - minp 
  
        if (minp < 0) { 
            alert("A minimum ár nem lehet ennél kevesebb: 0 Ft"); 
            priceInputvalue[0].value = 0; 
            minp = 0; 
        } 
  
        // Validate the input values 
        if (maxp > 100000) { 
            alert("A maximum ár nem lehet ennél több: 100000 Ft"); 
            priceInputvalue[1].value = 100000; 
            maxp = 100000; 
        } 
  
        if (minp > maxp - priceGap) { 
            priceInputvalue[0].value = maxp - priceGap; 
            minp = maxp - priceGap; 
  
            if (minp < 0) { 
                priceInputvalue[0].value = 0; 
                minp = 0; 
            } 
        } 
  
        // Check if the price gap is met  
        // and max price is within the range 
        if (diff >= priceGap && maxp <= rangeInputvalue[1].max) { 
            if (e.target.className === "min-input") { 
                rangeInputvalue[0].value = minp; 
                let value1 = rangeInputvalue[0].max; 
                rangevalue.style.left = `${(minp / value1) * 100}%`; 
            } 
            else { 
                rangeInputvalue[1].value = maxp; 
                let value2 = rangeInputvalue[1].max; 
                rangevalue.style.right =  
                    `${100 - (maxp / value2) * 100}%`; 
            } 
        } 
    }); 
  
    // Add event listeners to range input elements 
    for (let i = 0; i < rangeInputvalue.length; i++) { 
        rangeInputvalue[i].addEventListener("input", e => { 
            let minVal =  
                parseInt(rangeInputvalue[0].value); 
            let maxVal =  
                parseInt(rangeInputvalue[1].value); 
  
            let diff = maxVal - minVal 
              
            // Check if the price gap is exceeded 
            if (diff < priceGap) { 
              
                // Check if the input is the min range input 
                if (e.target.className === "min-range") { 
                    rangeInputvalue[0].value = maxVal - priceGap; 
                } 
                else { 
                    rangeInputvalue[1].value = minVal + priceGap; 
                } 
            } 
            else { 
              
                // Update price inputs and range progress 
                priceInputvalue[0].value = minVal; 
                priceInputvalue[1].value = maxVal; 
                rangevalue.style.left = 
                    `${(minVal / rangeInputvalue[0].max) * 100}%`; 
                rangevalue.style.right = 
                    `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`; 
            } 
        }); 
    } 
}

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}