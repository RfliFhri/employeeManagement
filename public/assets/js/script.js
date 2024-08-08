const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

document.querySelector(".theme-toggle").addEventListener("click", () => {
    toggleLocalStorage();
    toggleRootClass();
});

function toggleRootClass() {
    const current = document.documentElement.getAttribute("data-bs-theme");
    const inverted = current == "dark" ? "light" : "dark";
    document.documentElement.setAttribute("data-bs-theme", inverted);
}

function toggleLocalStorage() {
    if (isLight()) {
        localStorage.removeItem("light");
    } else {
        localStorage.setItem("light", "set");
    }
}

function isLight() {
    return localStorage.getItem("light");
}

if (isLight()) {
    toggleRootClass();
}
// jquery

$(document).ready(function () {
    // datepicker
    $("#hireDate").datepicker();
    // end datepicker

    // search
    $("#search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    // end search

    // Validation
    $("#employeeForm").on("submit", function (event) {
        event.preventDefault();
        var isValid = true;

        if ($("#name").val() === "") {
            $("#name").addClass("is-invalid");
            isValid = false;
        } else {
            $("#name").removeClass("is-invalid");
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test($("#email").val())) {
            $("#email").addClass("is-invalid");
            isValid = false;
        } else {
            $("#email").removeClass("is-invalid");
        }

        if ($("#phone").val() === "") {
            $("#phone").addClass("is-invalid");
            isValid = false;
        } else {
            $("#phone").removeClass("is-invalid");
        }

        if ($("#hireDate").val() === "") {
            $("#hireDate").addClass("is-invalid");
            isValid = false;
        } else {
            $("#hireDate").removeClass("is-invalid");
        }

        if ($("#position").val() === "") {
            $("#position").addClass("is-invalid");
            isValid = false;
        } else {
            $("#position").removeClass("is-invalid");
        }

        if (isValid) {
            $(this).unbind("submit").submit(); // Allow form submission if valid
        }
    });
    // end Validation
});
