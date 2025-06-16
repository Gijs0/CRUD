# UML Diagrammen - Festival Tickets Website

Dit document bevat alle up-to-date UML diagrammen voor de Festival Tickets website.

## 📁 Bestanden

### 1. Klassendiagram
- **Tekstversie**: `klassendiagram.txt` - Gedetailleerde beschrijving van alle klassen, attributen, methoden en relaties
- **PlantUML versie**: `plantuml-klassendiagram.puml` - Direct te gebruiken in PlantUML tools

### 2. Use Case Diagram  
- **Tekstversie**: `usecase-diagram.txt` - Overzicht van alle use cases, actoren en hun relaties
- **PlantUML versie**: `plantuml-usecase.puml` - Direct te gebruiken in PlantUML tools

### 3. Activiteitendiagram
- **Tekstversie**: `activiteitendiagram.txt` - Gedetailleerd proces van ticket aankoopprocedure

## 🛠️ Hoe Te Gebruiken

### Option 1: PlantUML (Aanbevolen)
1. Ga naar [PlantUML Online Server](http://www.plantuml.com/plantuml/uml/)
2. Kopieer de inhoud van de `.puml` bestanden
3. Plak in de editor en bekijk het diagram
4. Download als PNG, SVG of PDF

### Option 2: Draw.io (Visual Drag & Drop)
1. Ga naar [draw.io](https://app.diagrams.net/)
2. Gebruik de tekstversies als referentie
3. Maak diagrammen handmatig met drag & drop interface

### Option 3: Visual Studio Code
1. Installeer de "PlantUML" extensie
2. Open de `.puml` bestanden
3. Gebruik `Alt+D` om preview te bekijken

### Option 4: Lucidchart
1. Import de tekstversies
2. Gebruik Lucidchart's UML templates
3. Maak professionele diagrammen

## 📊 Diagram Overzicht

### Klassendiagram
**Doel**: Toont de structuur van het systeem
- 6 hoofdklassen: User, Festival, Ticket, Order, OrderItem, Category  
- Alle attributen en methoden per klasse
- Relaties tussen klassen (1:N, N:M)
- Foreign key relaties

### Use Case Diagram
**Doel**: Toont functionaliteit voor verschillende gebruikers
- 3 actoren: Gast, Klant, Admin
- 20 use cases verdeeld over publiek, klant en admin functionaliteit
- Include/Extend relaties tussen use cases

### Activiteitendiagram  
**Doel**: Toont het ticket aankoopproces stap voor stap
- Hoofdproces van homepage tot order bevestiging
- Beslissingspunten en alternatieve paden
- Error handling en uitzonderingen
- Parallelle admin processen

## 🎯 Belangrijke Features

### Website Functionaliteit
✅ **Publiek**: Festival browsing, registratie, login
✅ **Klanten**: Ticket kopen, winkelwagen, orders bekijken  
✅ **Admins**: Festival beheer, ticket beheer, order management

### Database Structuur
✅ **Users**: Role-based access (admin/customer)
✅ **Festivals**: Complete festival informatie met capaciteit
✅ **Tickets**: Verschillende types (early_bird, regular, vip)
✅ **Orders**: Status tracking (pending → paid → completed)
✅ **OrderItems**: Unieke ticket codes voor QR verificatie

### Business Logic
✅ **Real-time ticket beschikbaarheid**
✅ **Automatische capaciteit updates**  
✅ **Session-based winkelwagen**
✅ **Role-based permissions**
✅ **Unieke ticket code generatie**

## 🔄 Updates

Deze diagrammen zijn up-to-date met de huidige codebase van de Festival Tickets website:
- **Laravel Models**: User, Festival, Ticket, Order, OrderItem, Category
- **Controllers**: Alle CRUD operaties en business logic
- **Routes**: Publieke routes, auth routes, admin routes
- **Database Migrations**: Alle tabellen en relaties

## 📝 Notities

- Alle diagrammen zijn gebaseerd op de echte Laravel code
- Business rules zijn geëxtraheerd uit de models en controllers  
- Use cases komen overeen met de gedefinieerde routes
- Activiteitendiagram toont het echte aankoopproces zoals geïmplementeerd

Voor vragen over de diagrammen of implementatie, raadpleeg de broncode in de respectievelijke Laravel bestanden. 