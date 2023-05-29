const numResults = 10;

function onJson_pet(json) {
  console.log('JSON Pet ricevuto');
  console.log(json);
  // Svuotiamo la libreria
  const library = document.querySelector('#album-view');
  library.innerHTML = '';
  if (json.status == 400) {
	const errore = document.createElement("h1"); 
	const messaggio = document.createTextNode(json.detail); 
	errore.appendChild(messaggio); 
	library.appendChild(errore);
	return
  }
  
  // Leggi il numero di risultati
  const results = json.animals
  
  if(results.length == 0)
  {
	const errore = document.createElement("h1"); 
	const messaggio = document.createTextNode("Nessun risultato!"); 
	errore.appendChild(messaggio); 
	library.appendChild(errore);
  }

  // Processa ciascun risultato
  for(result of results)
  {
    // Leggiamo info
	console.log(result);
	if(result.primary_photo_cropped != null)
	{
		const immagine = result.primary_photo_cropped.medium;
		const album = document.createElement('div');
		album.classList.add('album');
		const img = document.createElement('img');
		img.src = immagine;
		const breed = document.createElement('h2');
		breed.textContent = result.breeds.primary;
	
		img.addEventListener('click', apriModale);
 
		// Aggiungiamo immagine e didascalia al div
		album.appendChild(img);
		album.appendChild(breed);
		// Aggiungiamo il div alla libreria
		library.appendChild(album);
	}
  }

  
}

function onJson_img(json) {
  console.log('JSON Img ricevuto');
  // Stampiamo il JSON per capire quali attributi ci servono
  console.log(json);
  // Svuotiamo la libreria
  const library = document.querySelector('#album-view');
  library.innerHTML = '';
  // Leggi il numero di risultati
  const results = json.hits
  for(result of results) {
	  console.log(result+' questo e un result');
	  }

  if(results.length == 0)
  {
	const errore = document.createElement("h1"); 
	const messaggio = document.createTextNode("Nessun risultato!"); 
	errore.appendChild(messaggio); 
	library.appendChild(errore);
  }

  // Processa ciascun risultato
  for(result of results)
  {
    // Leggiamo info
	const immagine = result.largeImageURL;

	const album = document.createElement('div');
    album.classList.add('album');
    const img = document.createElement('img');
    img.src = immagine;
	
	img.addEventListener('click', apriModale);
 
    // Aggiungiamo immagine e didascalia al div
    album.appendChild(img);
   
    // Aggiungiamo il div alla libreria
    library.appendChild(album);
  }
}

function onJson_gif(json) {
  console.log('JSON GIF ricevuto');
  console.log(json);
  // Svuotiamo la libreria
  const library = document.querySelector('#album-view');
  library.innerHTML = '';
  // Leggi il numero di risultati
  const results = json.data
  for(result of results) {
	  console.log(result+'questo e un result');
	  }

  if(results.length == 0)
  {
	const errore = document.createElement("h1"); 
	const messaggio = document.createTextNode("Nessun risultato!"); 
	errore.appendChild(messaggio); 
	library.appendChild(errore);
  }

  // Processa ciascun risultato
  for(result of results)
  {
	console.log(result);
    // Leggiamo info
	const immagine = result.images.downsized_medium.url;
	//console.log('questa e una ' +immagine);
	const album = document.createElement('div');
    album.classList.add('album');
    const img = document.createElement('img');
    img.src = immagine;
	
	//associo l'handler che apre la modale 
	img.addEventListener('click', apriModale);
 
    // Aggiungiamo immagine e didascalia al div
    album.appendChild(img);
   
    // Aggiungiamo il div alla libreria
    library.appendChild(album);
  }
}

function onResponse(response) {
  console.log('Risposta ricevuta');
  return response.json();
}

function getToken(json)
{
	token_data = json;
	console.log(json);
}

function onTokenResponse(response) {
  return response.json();
}

function search(event)
{
	// Impedisci il submit del form
	event.preventDefault();
  
	// Leggi valore del campo di testo
	const content = document.querySelector('#content').value;
  
	// verifico che sia stato effettivamente inserito del testo
	if(content) {
	    const text = encodeURIComponent(content);
		console.log('Eseguo ricerca elementi riguardanti: ' + text);
  
		// Leggi l'opzione scelta
		const tipo = document.querySelector('#tipo').value;
		console.log('Ricerco elementi di tipo: ' +tipo);
  

		//in base al tipo selezionato, eseguo funzioni diverse
		if(tipo === "immagine") {
	  		// Esegui fetch
			img_request = img_api_endpoint + '?key='  + key_img + '&q=' + text + '&per_page=' + numResults;
			fetch(img_request).then(onResponse).then(onJson_img);

	
		} else if(tipo === "gif") {
			gif_request = gif_api_endpoint + '?api_key='  + key_gif + '&q=' + text + '&limit=' + numResults;
			fetch(gif_request).then(onResponse).then(onJson_gif);
		} else if(tipo === 'pet')
		{
			const status = 'adoptable'
			fetch('https://api.petfinder.com/v2/animals?type=' + text + '&status=' + status, 
			{
				headers: {
					'Authorization': token_data.token_type + ' ' + token_data.access_token,
					'Content-Type': 'application/x-www-form-urlencoded'
				}
			}).then(onResponse).then(onJson_pet);
		}
	}
	else {
		alert("Inserisci il testo per cui effettuare la ricerca");
	}
}

//al click di uno dei contenuti trovati
function apriModale(event) {
	//creo un nuovo elemento img
	const image = document.createElement('img');
	//setto l'ID di questo img come immagine_post, a cui attribuisco alcune caratteristiche CSS
	image.id = 'immagine_post';
	//associo all'attributo src, l'src cliccato
	image.src = event.currentTarget.src;
	//appendo quest'immagine alla view modale
	modale.appendChild(image);
	//rendo la modale visibile
	modale.classList.remove('hidden');
	//blocco lo scroll della pagina
	document.body.classList.add('no-scroll');
}


function chiudiModale(event) {
	console.log(event);
	if(event.key === 'Escape')
	{
		//aggiungo la classe hidden 
		console.log(modale);
		modale.classList.add('hidden');
		//prendo il riferimento dell'immagine dentro la modale
		img = modale.querySelector('img');
		//e la rimuovo 
		img.remove();
		//riabilito lo scroll
		document.body.classList.remove('no-scroll');
	}
}

function prevent(event) {
	event.preventDefault();
}

function onInsert(response) {
	console.log('risposta ricevuta');
	return response.text();
}

//Keys and endpoints
const key_gif = 'mAvCsm3x3r5UhimJjQvAbWmHVSf8Uomb';		
const key_img = '16326848-36a4d0e195bb2375d6f41ea91';		
const gif_api_endpoint = 'http://api.giphy.com/v1/gifs/search' 
const img_api_endpoint = 'https://pixabay.com/api/' 

//Key and secret for Unsplash OAuth2.0 
const key_petfinder = '7enQNVqjn3UjEq6n01Y4vqEkx6rnN2dPy2gCSbORSFp1DlzXFT'
const secret_petfinder = 'ooIVyIMsx0g8KEMWO49rVwPRqPNwL9VaixniYJF6'
const pet_api_endpoint_token = 'https://api.petfinder.com/v2/oauth2/token' 
const pet_api_endpoint = 'https://api.petfinder.com/v2/animals' 

// All'apertura della pagina, richiediamo il token
let token_data;
fetch(pet_api_endpoint_token,
{
	method: 'POST',
	body: 'grant_type=client_credentials&client_id=' + key_petfinder + '&client_secret=' + secret_petfinder,
	headers:
	{
		'Content-Type': 'application/x-www-form-urlencoded'
	}
}
).then(onTokenResponse).then(getToken);

// Aggiungo event listener al form1 per la RICERCA
const form = document.querySelector('#search_content');
form.addEventListener('submit', search)

const modale = document.querySelector('#modale');
//creo il pulsante per la chiusura del post 
window.addEventListener('keydown', chiudiModale);

