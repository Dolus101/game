const changePass = document.querySelector('#change-password');
const openPassword = document.querySelector('.open-password');
const closePassword = document.querySelector('.close-password');

openPassword.addEventListener('click', () => {
    changePass.showmModal();
})

closePassword.addEventListener('click', () => {
    changePass.close();
})