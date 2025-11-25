// Restrict phone input
document.getElementById('phone').addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
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
    const regionCode = regionSelect.value;

    citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    provinceSelect.innerHTML = '<option value="">Select Province</option>';

    if (!regionCode) return;

    // NCR (13)
    if (regionCode === "130000000") {
        provinceSelect.disabled = true;
        provinceSelect.innerHTML = '<option value="Metro Manila">Metro Manila</option>';
        provinceSelect.classList.add("disabled");
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
