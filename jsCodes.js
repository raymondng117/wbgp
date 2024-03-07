document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('deleteButton').addEventListener("click", function (event) {
        event.preventDefault();
        var userConfirmed = window.confirm("The selected registration record will be deleted.");
        if (userConfirmed) {
            document.getElementById('deleteInput').click();
        }
    });
});

function handleSemesterChange(selectedSemester = null) {
    var selectElement = document.getElementById("semesterList");

    var selectedValue = selectElement.value;

    if (selectedValue !== selectedSemester) {
        var submitButton = document.getElementById("submitSemester");
        submitButton.click();
}
}



