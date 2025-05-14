<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Visitor Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="/visitor">LogiVisit</a>
        </div>
    </nav>

    <div class="container">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary"><i class="bi bi-person-lines-fill"></i> Visitor Log</h5>
                <a href="/visitor/exportpdf" class="btn btn-success btn-sm">Export to PDF</a>
            </div>
            <div class="card-body">
                <form method="get" class="row g-3 mb-3">
                    <div class="col-md-3">
                        <input type="text" name="full_name" class="form-control" placeholder="Filter by Full Name..." value="<?= esc($filters['full_name'] ?? '') ?>" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="institution" class="form-control" placeholder="Filter by Institution..." value="<?= esc($filters['institution'] ?? '') ?>" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="department" class="form-control" placeholder="Filter by Department..." value="<?= esc($filters['department'] ?? '') ?>" />
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="datetime_in_start" class="form-control" placeholder="Sign-In Start Date" value="<?= esc($filters['datetime_in_start'] ?? '') ?>" />
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="datetime_in_end" class="form-control" placeholder="Sign-In End Date" value="<?= esc($filters['datetime_in_end'] ?? '') ?>" />
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="datetime_out_start" class="form-control" placeholder="Sign-Out Start Date" value="<?= esc($filters['datetime_out_start'] ?? '') ?>" />
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="datetime_out_end" class="form-control" placeholder="Sign-Out End Date" value="<?= esc($filters['datetime_out_end'] ?? '') ?>" />
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="/visitor/log" class="btn btn-secondary">Reset Filters</a>
                    </div>
                </form>

                <?php if (empty($visitors)) : ?>
                    <p class="text-center text-muted">No visitors currently signed in.</p>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Full Name</th>
                                    <th>Institution</th>
                                    <th>Department</th>
                                    <th>Date &amp; Time In</th>
                                    <th>Date &amp; Time Out</th>
                                    <th>Signature</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($visitors as $visitor) : ?>
                                    <tr>
                                        <td><?= esc($visitor['full_name']) ?></td>
                                        <td><?= esc($visitor['institution']) ?></td>
                                        <td><?= esc($visitor['department']) ?></td>
                                        <td><?= esc($visitor['datetime_in']) ?></td>
                                        <td><?= esc($visitor['datetime_out'] ?? '-') ?></td>
                                        <td>
                                            <?php if (!empty($visitor['signature'])) : ?>
                                                <img src="<?= esc($visitor['signature']) ?>" alt="Signature" style="height: 50px;" />
                                            <?php else : ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
