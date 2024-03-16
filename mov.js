

const mov = () => {
    setTimeout(() => {
    const card = document.querySelector('.card');
    card.style.right = '-50%'}, 500);
};
const rmov = () => {
    setTimeout(() => {
    const card = document.querySelector('.card');
    card.style.right = '0'
}, 500);
}
const fr =(gm) => {
    setTimeout(() => {
    const fr=document.querySelector('.f1')
    const d=document.getElementById('container')
    fr.src = gm
    fr.style.top='100px'
    d.appendChild(iframe);
  

        }, 500);
}
