# 💚 GRAYBYTE DB STATUS CHECKER 💚

__A powerful PHP-based tool for checking the status of MySQL databases, offering both single and bulk (mass) checking capabilities. Built with real-time feedback using Server-Sent Events (SSE) and a responsive HTML interface, this script is designed for educational and ethical use by security professionals and developers.__

# 🔥 Features

__Dual Mode Operation__
__Single Check: Test an individual database connection by specifying host, user, password, and database name.__
__Mass Check: Process multiple database connections at once using a host|user|password|db configuration format.__
__Real-Time Feedback__
__Leverages Server-Sent Events (SSE) to stream live connection status updates directly to the browser.__
__Robust Error Handling__
__Gracefully manages MySQL connection errors and exceptions, delivering clear failure messages to the user.__
__Responsive User Interface__
__Clean, modern HTML interface with dynamic form switching between single and mass check modes.__
__Styled with custom CSS and Google Fonts (Play and Rubik Vinyl) for a visually appealing experience.__
__Performance Optimization__
__Efficiently handles bulk checks with minimal server strain, using output buffering and flushing for smooth real-time updates.__

# Usage Instructions 💚
__Single Check Mode__
__Select "SINGLE CHECK" from the mode dropdown.__
__Enter the database details:__
__Host__
__User__
__Password__
__Database Name__
__Click "CHECK" to test the connection.__
__View the real-time status (e.g., "WORKING..." or "FAILED...") below the form.__
__Mass Check Mode__
__Select "MASS CHECK" from the mode dropdown.__
__Input a list of database configurations in the textarea, one per line, in the format:__

__host|user|password|db__

__x.x.x.x|admin|pass123|mydb__
__localhost|root|root123|testdb__
__Click "CHECK" to start the bulk check process.__
__Monitor the live status updates for each entry (e.g., "FAILED..." or "WORKING...").__
__Resetting__
__Click the "RELOAD" button to refresh the page and start over.__


__FOR MORE INFORMATION AND SUPPORT, CONTACT : https://t.me/rex_cc__
