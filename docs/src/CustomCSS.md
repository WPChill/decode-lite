# Helpful Custom CSS entries
*A collection of CSS snippets that anyone can use in Decode's Custom CSS feature in the Other Options section of the theme Customize menu.*

### Change the size of the header image:
`.site-logo { max-height: 8.5em; }`<br>
8.5ems is the default. Raise or lower this amount to what suits you.

### Fit background image to page width:
`body.custom-background { background-size: cover; }`

### Change the size of the social icons:
`.sociallink svg { height: 2.5em; width: 2.5em; }`<br>
I suggest that you do not change this without using media queries because the social icons are responsively sized.

### Change the color of the social icons:
`.social-icon-fill { fill: #00B0CC; }`

### Change the color of the menu and menu close icons:
`.menu-icon, .close-icon { fill: #00B0CC; }`

### Change the font size of posts and pages:
`.entry-content { font-size: 1em; }`<br>
1em is the default.

### Change the maximum width of the main content area:
`.site-main, .site-footer { max-width: 45em; }`<br>
45em is the default. It is recommended that the footer be the same width as the main content area.

### Change the maximum width of the header:
`.site-header { max-width: 60em; }`<br>
60em is the default.

### Increase size of comment box by default:
`textarea#comment { height: 4em; }`<br>
7em is the default.

### Make the sidebar pop closed when the page loads
`.sidebar.left {
	animation: pop-closed 0.75s 0.75s;
}`

### Prevent current menu item from shaking on hover:
`.menu .current-menu-item > a:hover,
.menu .current_page_item > a:hover {
	-webkit-animation: none;
	animation: none;
}`

### Remove the border between the header and the main section of the site:
`.site-header { border-bottom: none; }`

### Remove the the border from below posts:
`.post .entry-meta { border-bottom: none; }`

### Remove the the border under hovered links in an entry:
`.no-touch .entry-content a:hover { border-bottom: none; }`

### Hide Page Titles on archive pages:
`.archive .page-header { display: none; }`

### Hide Page Titles on category pages:
`.category.page-header { display: none; }`

### Hide Page Titles on specific category pages:
`.category-NAMEOFCATEGORY .page-header { display: none; }`

