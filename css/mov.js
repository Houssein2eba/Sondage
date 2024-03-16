

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


 let pages = [
  { title: 'الرئيسية', url: 'http://localhost/prep/home.html' },
  { title: 'استطلاع الرأي', url: 'http://localhost/prep/prsd/sond.html' },
  { title: 'تقييمات', url: 'http://localhost/prep/etw/etw.html' },
   { title: 'hashimi', url: 'http://localhost/prep/etw/etw.html#h1' },
    { title: 'houceyne', url: 'http://localhost/prep/etw/etw.html#h2' },
     { title: 'sidiya', url: 'http://localhost/prep/etw/etw.html#h3' },
      { title: 'el ghadi', url: 'http://localhost/prep/etw/etw.html#h4' },
       { title: 'Amanatoullah', url: 'http://localhost/prep/etw/etw.html#h5' },
        { title: 'bouha', url: 'http://localhost/prep/etw/etw.html#h6' },
      { title: 'Ibrahima', url: 'http://localhost/prep/etw/etw.html#h7' },
       { title: 'Mohamed Abdalahi', url: 'http://localhost/prep/etw/etw.html#h8' },
        { title: 'didi', url: 'http://localhost/prep/etw/etw.html#h9' },
         { title: 'Fatimata', url: 'http://localhost/prep/etw/etw.html#h10' },
          { title: 'Lemrabott', url: 'http://localhost/prep/etw/etw.html#h11' },
           { title: 'Zerroug', url: 'http://localhost/prep/etw/etw.html#h12' },
            { title: 'mactor', url: 'http://localhost/prep/etw/etw.html#h13' },
             { title: 'Oumar Beyate', url: 'http://localhost/prep/etw/etw.html#h14' },
              { title: 'Ramla', url: 'http://localhost/prep/etw/etw.html#h15' },
               { title: 'Zeinebou', url: 'http://localhost/prep/etw/etw.html#h16' },
                { title: 'Abdellahi El Wavi', url: 'http://localhost/prep/etw/etw.html#h17' },
                 { title: 'Biby', url: 'http://localhost/prep/etw/etw.html#h18' },
                  { title: 'Moussa', url: 'http://localhost/prep/etw/etw.html#h19' },
                   { title: 'S’Lemhoum', url: 'http://localhost/prep/etw/etw.html#h20' },
  { title: 'الألعاب', url: 'http://localhost/prep/game/Menja/Menja.html' },

   { title: 'vote', url: 'http://localhost/prep/prsd/sond.html#h1' },
    { title: 'Agriculture and Food Security', url: 'http://localhost/prep/prsd/sond.html#h2' },
     { title: 'Corruption and Transparency', url: 'http://localhost/prep/prsd/sond.html#h3' },
      { title: 'Culture and Arts', url: 'http://localhost/prep/prsd/sond.html#h4' },
       { title: 'Education and Schools', url: 'http://localhost/prep/prsd/sond.html#h5' },
        { title: 'Energy and Water', url: 'http://localhost/prep/prsd/sond.html#h6' },
      { title: 'Environment and Cleanliness', url: 'http://localhost/prep/prsd/sond.html#h7' },
       { title: 'Government Services', url: 'http://localhost/prep/prsd/sond.html#h8' },
        { title: 'Housing and Real Estate', url: 'http://localhost/prep/prsd/sond.html#h9' },
         { title: 'ما رأيكم في الأستاذ', url: 'http://localhost/prep/prsd/sond.html#h10' },
          { title: 'Infrastructure and Roads', url: 'http://localhost/prep/prsd/sond.html#h11' },
           { title: 'Migration and Integration', url: 'http://localhost/prep/prsd/sond.html#h12' },
            { title: 'Local Politics', url: 'http://localhost/prep/prsd/sond.html#h13' },
             { title: 'Healthcare and Hospitals', url: 'http://localhost/prep/prsd/sond.html#h14' },
              { title: 'Security and Police', url: 'http://localhost/prep/prsd/sond.html#h15' },
               { title: 'Sports and Entertainment', url: 'http://localhost/prep/prsd/sond.html#h16' },
                { title: 'Taxes and Fees', url: 'http://localhost/prep/prsd/sond.html#h17' },
                 { title: 'Public Transportation', url: 'http://localhost/prep/prsd/sond.html#h19' },
                   { title: 'Unemployment and Job Opportunities', url: 'http://localhost/prep/prsd/sond.html#h20' },

];

function searchFunction() {
  let input = document.getElementById('searchInput');
  let filter = input.value.toLowerCase();
  let results = document.getElementById('searchResults');
  results.style.display = 'block';
  results.innerHTML = '';
  let i = 0
  
  for (let i = 0; i < pages.length; i++) {
    let title = pages[i].title;
    if (title.toLowerCase().indexOf(filter) > -1) {
    let div = document.createElement('div');
    div.innerHTML = title;
    div.onclick = function() {
        const fr = document.querySelector('.f1');
        
        const d = document.getElementById('container');
        fr.src = pages[i].url;
        d.appendChild(fr); 
         
                results.style.display = 'none';
    };
    results.appendChild(div);
}

  }
}
