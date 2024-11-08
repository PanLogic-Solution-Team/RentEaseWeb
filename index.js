const express = require('express');
const app = express();
const port = process.env.port || 8000;

const appRouter=require('./app.js');
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

app.use('/api', appRouter); // Use the router with a base path
console.log(`http://localhost:${port}/api`);

app.listen(port, () => {
  console.log(`Server running on port http://localhost:${port}`);
});


