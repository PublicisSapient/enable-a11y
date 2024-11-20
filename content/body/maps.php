<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accessible Map with List View</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    #map {
      width: 100%;
      height: 400px;
    }
    .locations {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <main>
    <h1>Interactive Map and Accessible List View</h1>
    <section>
        <p>
        An accessible map is a map that is designed to be usable by people with disabilities, ensuring that all users, regardless of their abilities, can interact with and understand the map's content. Accessibility for maps involves making sure that all interactive elements, such as markers, zoom controls, and map regions, are fully navigable via keyboard and screen reader software. It also includes providing alternative ways to view and interact with the map, such as list views of map markers or location descriptions, which help users who cannot rely on visual cues. Additionally, adding proper ARIA roles, landmarks, and text alternatives ensures that the map’s functionality is clear and easily accessible for all users.
        </p>
    </section>

    <!-- Accessibility Instructions Section -->
    <section aria-labelledby="accessibility-features" tabindex="0" >
      <h2 id="accessibility-features">Accessibility Features</h2>
      <p>
        This map interface has been designed for accessibility with ARIA roles and a keyboard-friendly layout:
      </p>
      <ul>
        <li><strong>ARIA roles and landmarks:</strong> The map container has <code>role="region"</code> and is <code>aria-labelledby</code> an instruction to help screen readers identify its function and purpose.</li>
        <li><strong>Alternative list view:</strong> A list of locations is available below the map. Each location is represented by a button labeled with an <code>aria-label</code> describing the location. This allows users to select locations without navigating through the map itself.</li>
        <li><strong>Keyboard navigation:</strong> The map container is focusable with <code>tabindex="0"</code>, and users can use the list to move the map and activate locations directly. Each location in the list opens the corresponding info window on the map when selected.</li>
      </ul>
    </section>

    <section role="region" aria-labelledby="map-instructions" tabindex="0">
      <p id="map-instructions">
        Use the list below the map to select a location. Each location can be accessed without navigating the map itself.
      </p>
      <div aria-label="Interactive map showing various locations"></div>
    </section>

    <!-- Accessible List View -->
    <div class="enable-example">
     <p>The following is the map container</p>
   
    </div>
    <div id="map">
        <section  role="region" aria-labelledby="map" tabindex="0"></section>
    </div>
    <section class="locations" role="region" aria-labelledby="location-list-title" >
      <h2 id="location-list-title">List of Locations</h2>
      <ul aria-label="List of locations" id="location-list">
        <!-- JavaScript will populate this list with items -->
      </ul>
    </section>
    
  </main>

  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
    // Initialize map
    
    const map = L.map('map').setView([25.7617, -80.1918], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap contributors',
      
    }).addTo(map);

    // Sample location data
    const locations = [
      { id: 1, name: 'North office', coords: [25.7617, -80.1918], description: 'First location description' },
      { id: 2, name: 'East office', coords: [25.7637, -80.1910], description: 'Second location description' },
      { id: 3, name: 'West office', coords: [25.7657, -80.1920], description: 'Third location description' }
    ];

    // Add markers and list items for each location

    locations.forEach(location => {
      const marker = L.marker(location.coords).addTo(map)
        .bindPopup(`<strong>${location.name}</strong><br>${location.description}`);

      // Add each location to the list as a button
      const listItem = document.createElement('li');
      const button = document.createElement('button');
      button.innerText = location.name;
      button.setAttribute('aria-label', `${location.name}: ${location.description}`);
      button.onclick = () => {
        map.setView(location.coords, 15); // Center map on marker
        marker.openPopup(); // Open info window
      };
      listItem.appendChild(button);
      document.getElementById('location-list').appendChild(listItem);
    });
  </script>

<?php includeShowcode("map", "", "", "", true, 2); ?>
<script type="application/json" id="map-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Create accessible map markup",
      "highlight": "%OPENCLOSECONTENTTAG%section",
      "notes": "Ensure the map container is focusable by adding <code>tabindex='0'</code> and providing a descriptive <code>aria-labelledby</code> for screen readers."
    },
 {
      "label": "Add interactive markers with accessible labels",
      "highlight": "%OPENCLOSECONTENTTAG%img",
      "notes": "Each marker on the map should be a focusable <code>button</code> element, with an <code>aria-label</code> that describes its purpose to screen readers."
    }

  ]
}
</script>

</body>
</html>
