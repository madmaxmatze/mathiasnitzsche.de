/* GooleTagManager ***********************************************************/
(function(w,d,s,l,i){
w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KNC3PQG');


/* Hashnode Posts ************************************************************/
var writingElement = document.getElementById("writing");
if (writingElement) {
  fetch("https://code.mathiasnitzsche.de/hasnode-api/v1/user/madmaxmatze/posts?1hCache=" + ~~(Date.now()/1000/60/60), {cache: "force-cache"})
    .then(response => response.json())
    .then(posts => posts.slice(0, 2).forEach((post, i) =>
      writingElement.children.item(i).outerHTML = `<li>
        <a href="https://${post.domain}/${post.slug}" target="_blank">
          ${post.title} (${(new Date(post.dateAdded)).toLocaleDateString(undefined, { month: 'short', day: 'numeric' })})
        </a>
      </li>`));
}


/* TypeWriter *****************************************************************/
var typedElement = document.getElementById("typed");
if (typedElement) {
  new Typed(typedElement, {
    strings: [
      "I'm a coder",
      "I'm a proud father of two",
      "Ich bin ein Berliner",
      "I build tech teams and products @work",
      "I practice Muay-Thai",
      "I'm " + new Date(Date.now() - 62585735726663).getFullYear() + " years old",
      "I run this site since 2002",
    ].sort(() => .5 - Math.random()),   // shuffle: true, <- buggy
    typeSpeed: 90,
    backDelay: 700,
    loop: true,
  });
}