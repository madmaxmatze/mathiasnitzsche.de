var writingElement = document.getElementById("writing");
if (writingElement) {
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
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query })
        })
            .then(response => response.json())
            .then(json => {
                writingElement.innerHTML = json.data.user.publication.posts.slice(0, 2).map(post => (
                    `<li><a href="https://${json.data.user.publicationDomain}/${post.slug}" target="_blank">
                        ${post.title} (${(new Date(post.dateAdded)).toLocaleDateString(undefined, { month: 'short', day: 'numeric' })})
                    </a></li>`
                )).join("") + writingElement.innerHTML;
            });
    })();
}

var typedElement = document.getElementById("typed");
if (typedElement) {
    new Typed(typedElement, { // https://github.com/mattboldt/typed.js/
        strings: [
            "I'm a coder"
            , "I'm a proud father of two"
            , "Ich bin ein Berliner"
            , "I build tech teams and products @work"
            , "I practice Muay-Thai"
            , "I'm " + new Date(Date.now() - 62585735726663).getFullYear() + " years old"
            , "I run this site since 2002"
        ].sort(() => .5 - Math.random())
        , typeSpeed: 90
        , backDelay: 700
        , loop: true
        //,shuffle: true // <- buggy
    });
}