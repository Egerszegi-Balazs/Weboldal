document.addEventListener("DOMContentLoaded", function () {
    const languageSwitcher = document.getElementById("languageSwitcher");
    let currentLang = "hu";

    // Load translations
    fetch("translations.json")
        .then(response => response.json())
        .then(data => {
            const translations = data;

            function translatePage(lang) {
                document.querySelectorAll("[data-i18n]").forEach(element => {
                    const key = element.getAttribute("data-i18n");
                    if (translations[lang] && translations[lang][key]) {
                        element.textContent = translations[lang][key];
                    }
                });
            }

            // Translate page to default language on load
            translatePage(currentLang);

            // Handle language change
            languageSwitcher.addEventListener("change", function () {
                currentLang = languageSwitcher.value;
                translatePage(currentLang);
            });
        })
        .catch(error => console.error("Error loading translations:", error));
});
