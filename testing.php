
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  

<form id="form">
  <input type="text" name="text1" value="foo">
  <input type="text" name="text2" value="bar">
  <input type="text" name="text2" value="baz">
  <input type="checkbox" name="check" checked disabled>
</form>

<output id="output"></output>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    const form = document.getElementById('form');
const formData = new FormData(form);

const output = document.getElementById('output');

for (const [key, value] of formData) {
  output.textContent += `${key}: ${value}\n`;
}
</script>
    
</body>
</html>