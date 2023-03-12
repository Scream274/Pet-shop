window.onload = () => {
    const [...inputs] = form.elements;

    const name = inputs[0];
    const email = inputs[1];
    const subject = inputs[2];
    const message = inputs[3];
    const confirmPassword = inputs[4];

    form.onsubmit = (e) => {
        let isValid = true;
        let alertMessage = "";

        if (name.value.length < 3) {
            isValid = false;
            alertMessage += "\nName is too short!";
        }

        if (!name.value.match(/^[A-z ]*$/)) {
            isValid = false;
            alertMessage += "\nOnly letters and spaces are allowed in the name!";
        }

        if (subject.value.length < 3) {
            isValid = false;
            alertMessage += "\nSubject is too short!";
        }

        if (message.value.length < 3) {
            isValid = false;
            alertMessage += "\nMessage is too short!";
        }

        if (message.value.length > 1000) {
            isValid = false;
            alertMessage += "\nMessage is too long.";
        }

        if (!email.value.match(/^\S+@\S+\.\S+$/)) {
            isValid = false;
            alertMessage += "\nEmail is not valid!";
        }

        if (!isValid) {
            e.preventDefault();
            alert(alertMessage);
        }
    }
}