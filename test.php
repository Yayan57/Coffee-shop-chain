<!DOCTYPE html>
<html>
  <head>
    <title>Two Centered Columns</title>
    <style>
      /* This CSS code styles the container for the two columns */
      .container {
        display: flex;
        justify-content: center;
      }
      /* This CSS code styles the left and right columns */
      .left-column,
      .right-column {
        width: 200px;
        padding: 20px;
        border: 1px solid #ccc;
        margin: 0 10px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="left-column">
        <h2>Left Column</h2>
        <p>This is the content of the left column.</p>
      </div>
      <div class="right-column">
        <h2>Right Column</h2>
        <p>This is the content of the right column.</p>
      </div>
    </div>
  </body>
</html>