// Restrict phone input
document.getElementById('phone').addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
});

document.addEventListener("DOMContentLoaded", () => {
                const steps = document.querySelectorAll(".checkout-step");
                const nextBtns = document.querySelectorAll(".next-btn");
                const prevBtns = document.querySelectorAll(".prev-btn");
                const processSteps = document.querySelectorAll(".process-step");
                let currentStep = 0;

                function showStep(index) {
                    steps.forEach((step, i) => {
                        step.classList.toggle("step-active", i === index);
                    });
                    updateProcessStep(index);
                }

            function updateProcessStep(index) {
                processSteps.forEach((step, i) => {
                    if (i <= index) {
                        step.classList.add("process-step-active");
                        step.classList.remove("process-step");
                    } else {
                        step.classList.remove("process-step-active");
                        step.classList.add("process-step");
                    }
                });
            }

                nextBtns.forEach(btn => {
                    btn.addEventListener("click", () => {
                        if (currentStep < steps.length - 1) {
                            currentStep++;
                            showStep(currentStep);
                        }
                    });
                });

                prevBtns.forEach(btn => {
                    btn.addEventListener("click", () => {
                        if (currentStep > 0) {
                            currentStep--;
                            showStep(currentStep);
                        }
                    });
                });

                const paymentOptions = document.querySelectorAll(".payment-option");
                const paymentInput = document.getElementById("payment_method");
                paymentOptions.forEach(option => {
                    option.addEventListener("click", () => {
                        paymentOptions.forEach(o => o.classList.remove("active"));
                        option.classList.add("active");
                        paymentInput.value = option.dataset.value;
                    });
                });

                showStep(currentStep);
            });
            
const regionSelect = document.getElementById("region");
const provinceSelect = document.getElementById("province");
const citySelect = document.getElementById("city");
const barangaySelect = document.getElementById("barangay");

// Fetch regions
fetch("https://psgc.gitlab.io/api/regions")
    .then(res => res.json())
    .then(data => {
        regionSelect.innerHTML = '<option value="">Select Region</option>';
        data.forEach(region => {
        const option = document.createElement("option");
        option.value = region.code;
        option.textContent = region.name;
        regionSelect.appendChild(option);
        });
    });

    // Region change
    regionSelect.addEventListener("change", () => {
        const selectedRegion = regionSelect.options[regionSelect.selectedIndex].text;
        document.getElementById("region_name").value = selectedRegion;

        const regionCode = regionSelect.value;

        citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        provinceSelect.innerHTML = '<option value="">Select Province</option>';

        if (!regionCode) return;

        // NCR (13)
        if (regionCode === "130000000") {
            provinceSelect.disabled = true;

            provinceSelect.innerHTML = '<option value="Metro Manila">Metro Manila</option>';
            document.getElementById("province_name").value = "Metro Manila";

            fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/cities`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(city => {
                        const option = document.createElement("option");
                        option.value = city.code;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                });
        } else {
            provinceSelect.disabled = false; // Enable province select
            fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(province => {
                        const option = document.createElement("option");
                        option.value = province.code;
                        option.textContent = province.name;
                        provinceSelect.appendChild(option);
                    });
                });
        }
    });

    // Province change
    provinceSelect.addEventListener("change", () => {
        const selectedProvince = provinceSelect.options[provinceSelect.selectedIndex].text;
        document.getElementById("province_name").value = selectedProvince;

        const provinceCode = provinceSelect.value;

        citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        if (!provinceCode) return;

        fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities`)
            .then(res => res.json())
            .then(data => {
                data.forEach(city => {
                    const option = document.createElement("option");
                    option.value = city.code;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            });
    });

    // City change
    citySelect.addEventListener("change", () => {
        const selectedCity = citySelect.options[citySelect.selectedIndex].text;
        document.getElementById("city_name").value = selectedCity;

        const cityCode = citySelect.value;

        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        if (!cityCode) return;

        fetch(`https://psgc.gitlab.io/api/cities/${cityCode}/barangays`)
            .then(res => res.json())
            .then(data => {
                data.forEach(barangay => {
                    const option = document.createElement("option");
                    option.value = barangay.code;
                    option.textContent = barangay.name;
                    barangaySelect.appendChild(option);
                });
            });
    });

    barangaySelect.addEventListener("change", () => {
        const barangayName = barangaySelect.options[barangaySelect.selectedIndex].text;
        document.getElementById("barangay_name").value = barangayName;
    });

