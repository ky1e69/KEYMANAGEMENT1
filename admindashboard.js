function loadContent(page) {
    fetch(page)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Failed to load ${page}`);
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('content').innerHTML = data;
            
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('content').innerHTML = "<p>Failed to load content.</p>";
        });
}
