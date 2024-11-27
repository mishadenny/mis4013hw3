  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 12px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f4f4f4;
    }

    tbody tr:hover {
      background-color: #dcdcdc; /* Highlight on hover */
    }
  </style>
<div class="row">
  <div class="col">
    <h1>Actors</h1>
  </div>
  <div class="col-auto">
    <?php include "view-actors-newform.php"; ?>
  </div>
</div>

<p>
  <button onclick="sortTable(0)">ID</button>
  <button onclick="sortTable(1)">Name</button>
  <button onclick="sortTable(2)">Age</button>
</p>

<div class="table-responsive">
  <table id="actorsTable" class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php 
        while ($instructor = $instructors->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $instructor['actor_id']; ?></td>
          <td><?php echo $instructor['actor_name']; ?></td>
          <td><?php echo $instructor['age']; ?></td>
          <td>
            <?php include "view-actors-editform.php"; ?>
          </td>
          <td>
            <form method="post" action="">
              <input type="hidden" name="iid" value="<?php echo $instructor['actor_id']; ?>">
              <input type="hidden" name="actionType" value="Delete">
              <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">
                Delete
              </button>
            </form>
          </td>
          <td><a href="courses-by-instructor.php?id=<?php echo $instructor['actor_id']; ?>">Shows</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
function sortTable(columnIndex) {
  var table, rows, switching, i, x, y, shouldSwitch, isNumeric;
  table = document.getElementById("actorsTable");
  switching = true;

  // Determine if the column should be sorted numerically
  isNumeric = columnIndex === 0 || columnIndex === 2; // Columns 0 (ID) and 2 (Age)

  while (switching) {
    switching = false;
    rows = table.rows;

    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[columnIndex];
      y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

      if (isNumeric) {
        // Compare as numbers
        if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
          shouldSwitch = true;
          break;
        }
      } else {
        // Compare as strings
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }

    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

</script>
