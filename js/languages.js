const dictionary = {
    concentration: {
        en: "Concentration of PM2.5",
        bg: "Концентрация на PM2.5"
    },
    temperature: {
        en: "Temperature",
        bg: "Температура"
    },
    humidity: {
        en: "Humidity",
        bg: "Влажност"
    },
    pressure: {
        en: "Pressure",
        bg: "Налягане"
    },
    rename: {
        en: "Rename",
        bg: "Преименуване"
    },
    remove: {
        en: "Remove",
        bg: "Премахване"
    },
    addSensor: {
        en: "Add Sensor",
        bg: "Добави сензор"
    },
    map: {
        en: "Map",
        bg: "Карта"
    },
    account: {
        en: "Account",
        bg: "Акаунт"
    },
    settings: {
        en: "Settings",
        bg: "Настройки"
    },
    login: {
        en: "Log In",
        bg: "Влизане"
    },
    logout: {
        en: "Logout",
        bg: "Излизане"
    },
    signup: {
        en: "Sign Up",
        bg: "Регистрация"
    },
    save: {
        en: "Save",
        bg: "Запазване"
    },
    emailAddress: {
        en: "Email address",
        bg: "Имейл адрес"
    },
    changeEmailAddress: {
        en: "Change email address",
        bg: "Промяна на имейл адрес"
    },
    newEmailAddress: {
        en: "New email address",
        bg: "Нов имейл адрес"
    },
    password: {
        en: "Password",
        bg: "Парола"
    },
    rePassword: {
        en: "Repeat password",
        bg: "Въведете паролата отново"
    },
    changePassword: {
        en: "Change password",
        bg: "Промяна на паролата"
    },
    oldPassword: {
        en: "Old password",
        bg: "Стара парола"
    },
    newPassword: {
        en: "New password",
        bg: "Нова парола"
    },
    reNewPassword: {
        en: "Repeat new password",
        bg: "Въведете новата парола отново"
    },
    forgottenPassword: {
        en: "Forgotten Password",
        bg: "Забравена парола"
    },
    changeUsername: {
        en: "Change username",
        bg: "Промяна на потребителското име"
    },
    username: {
        en: "Username",
        bg: "Потребителско име"
    },
    deleteAccount: {
        en: "Delete account",
        bg: "Изтриване на акаунт"
    },
    continue: {
        en: "Continue",
        bg: "Продължаване"
    },
    close: {
        en: "Close",
        bg: "Затваряне"
    },
    enterNewName: {
        en: "Enter new name:",
        bg: "Въведете ново име:"
    },
    enterSensorId: {
        en: "Enter sensor id:",
        bg: "Въведете id на сензора:"
    },
    createSensor: {
        en: "Create Sensor",
        bg: "Създаване на сензор"
    },
    noSensorsAdded: {
        en: "You don't have any sensors added. You can add one by clicking <a onclick='addSensor()' class='waves-effect waves-light btn'>Here</a>",
        bg: "Нямате добавени сензори. Може да добавите един като натиснете <a onclick='addSensor()' class='waves-effect waves-light btn'>Тук</a>"
    },
    changeLanguage: {
        en: "Language",
        bg: "Език"
    },
    weeklyNotificatios: {
        en: "Weekly notificatios",
        bg: "Седмични известия"
    }
};

function translate(item, lang){
    document.write(dictionary[item][lang]);
}
function setLS(lang){
    localStorage.setItem("language", lang);
    location.reload();
}
let language = localStorage.getItem("language");
if(language === null){
    localStorage.setItem("language", "en");
    language = localStorage.getItem("language");
}