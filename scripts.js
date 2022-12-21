/** Google Tag Manager */
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KNC3PQG');
/** End Google Tag Manager */


if (document.getElementById("writing")) {
  (async () => {
    var query = `{
        user(username: "madmaxmatze") {
        blogHandle
        publicationDomain
        publication {
            posts(page: 0) {
            dateAdded
            slug
            title
            brief
            coverImage
            }
        }
        }
    }`;
    fetch('https://api.hashnode.com/', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({query})
    })
    .then(response => response.json())
    .then(json => {
        document.getElementById("writing").innerHTML = json.data.user.publication.posts.slice(0, 2).map(post => (
        `<li><a href="https://${json.data.user.publicationDomain}/${post.slug}" target="_blank">
            ${post.title} (${ (new Date (post.dateAdded)).toLocaleDateString(undefined, {month: 'short', day: 'numeric'})})
        </a></li>`
        )).join("") + document.getElementById("writing").innerHTML;
    });
  })();
}
    

if (document.getElementsByClassName("typed")) {
  new Typed(".typed", { // https://github.com/mattboldt/typed.js/
    strings: [
        "I'm a coder"
        ,"I'm a proud father of two"
        ,"Ich bin ein Berliner"
        ,"I build tech teams and products @work"
        ,"I practice Muay-Thai"
        ,"I'm " + new Date(Date.now()-62585735726663).getFullYear() + " years old"
        ,"I run this site since 2002"
    ].sort(() => .5 - Math.random())
    ,typeSpeed: 90
    ,backDelay: 700
    ,loop: true
    //,shuffle: true // <- buggy
  });
}