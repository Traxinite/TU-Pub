
const searchInput = document.getElementById("searchInput");
const searchBtn = document.getElementById("searchBtn");
const cards = document.querySelectorAll(".research-card");
const filterButtons = document.querySelectorAll(".filter-btn");
const resultCount = document.getElementById("resultCount");
const noResults = document.getElementById("noResults");

let activeDepartment = "all";

function filterResearch() {
    const searchText = searchInput.value.trim().toLowerCase();
    let visibleCount = 0;

    cards.forEach(card => {
        const title = card.querySelector("h3")
            .textContent.toLowerCase();

        const content = card.textContent.toLowerCase();

        const department = card.dataset.department;

        const matchesSearch =
            title.includes(searchText) ||
            content.includes(searchText);

        const matchesDepartment =
            activeDepartment === "all" ||
            department === activeDepartment;

        if (matchesSearch && matchesDepartment) {
            card.hidden = false;
            card.style.display = "flex";
            visibleCount++;
        } else {
            card.hidden = true;
            card.style.display = "none";
        }
    });

    resultCount.textContent =
        `${visibleCount} publication(s) found`;

    noResults.hidden = visibleCount !== 0;
}

// Search while typing
searchInput.addEventListener("input", filterResearch);

// Search button
searchBtn.addEventListener("click", () => {
    filterResearch();
    document.getElementById("publications")
        .scrollIntoView({ behavior: "smooth" });
});

// Department buttons
filterButtons.forEach(button => {
    button.addEventListener("click", () => {
        activeDepartment = button.dataset.filter;

        filterButtons.forEach(btn => {
            btn.classList.remove("active");
        });

        button.classList.add("active");

        filterResearch();
    });
});

// Show initial result count
filterResearch();
