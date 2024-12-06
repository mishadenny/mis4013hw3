<div class="row mt-5">
  <!-- Table Section -->
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-striped">>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Headquarters</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while ($platform = $platformWithCounts->fetch_assoc()) { // Changed variable name
          ?>
            <tr>
              <td><?php echo $platform['platform_id']; ?></td>
              <td><?php echo $platform['platform_name']; ?></td>
              <td><?php echo $platform['headquarters']; ?></td>
              <td>
                <?php include "view-platform-editform.php"; ?>
              </td>
              <td>
                <form method="post" action="">
                  <input type="hidden" name="cid" value="<?php echo $platform['platform_id']; ?>">
                  <input type="hidden" name="actionType" value="Delete">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">
                    Delete
                  </button>
                </form>
              </td>
              <td>
                <form method="post" action="shows-by-platform.php">
                  <input type="hidden" name="cid" value="<?php echo $platform['platform_id']; ?>">
                  <button type="submit" class="btn btn-info">Shows</button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Donut Chart Section -->
  <div class="col-md-6">
    <h2>Platform Distribution by Show Count</h2>
    <canvas id="platformChart" style="width:100%;max-width:600px;"></canvas>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
<?php
// Prepare data for the chart
$chartData = [];
$platformWithCounts->data_seek(0); // Reset the pointer to fetch data again
while ($platform = $platformWithCounts->fetch_assoc()) {
    $chartData['labels'][] = $platform['platform_name'];
    $chartData['data'][] = (int)$platform['show_count']; // Cast to integer
}
?>
const platformLabels = <?php echo json_encode($chartData['labels']); ?>;
const platformData = <?php echo json_encode($chartData['data']); ?>;
const platformColors = platformLabels.map((_, i) => hsl(${(i * 50) % 360}, 70%, 50%));

new Chart(document.getElementById("platformChart"), {
  type: "doughnut",
  data: {
    labels: platformLabels,
    datasets: [{
      backgroundColor: platformColors,
      data: platformData
    }]
  },
  options: {
    title: {
      display: true,
      text: "Platform Distribution by Show Count"
    }
  }
});
</script>
