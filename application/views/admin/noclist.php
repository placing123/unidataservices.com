<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
         
          <div class="card">
            <div class="card-header">
              <h4><?php echo $title; ?></h4>
           
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                     
                      <th>customerID</th>
                      <th> NOC</th>
                      <th> Amount</th>
                      <th> Date</th>
                   
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sr = 0;
                    foreach ($rec as $r) : $sr++; ?>
                      <tr>
                        <td><?php echo $r->customer_id; ?></td>
                        <td>  <a href="<?php echo  $r->noc; ?>"   target="_blank"  >Download</a></td>
                        <td><?php echo $r->amount; ?></td>
                        <td><?php echo $r->create_at; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

