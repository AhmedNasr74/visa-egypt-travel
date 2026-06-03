# Copy mailing system into another Laravel project
# Usage: .\install.ps1 -Target "C:\path\to\other-laravel-project"

param(
    [Parameter(Mandatory = $true)]
    [string]$Target
)

$Source = $PSScriptRoot
$ErrorActionPreference = "Stop"

if (-not (Test-Path (Join-Path $Target "artisan"))) {
    Write-Error "Target does not look like a Laravel project (artisan not found): $Target"
}

$maps = @(
    @{ From = "app\Helpers\EmailHelper.php"; To = "app\Helpers\EmailHelper.php" },
    @{ From = "app\Services\DualEmailSender.php"; To = "app\Services\DualEmailSender.php" },
    @{ From = "app\Mail"; To = "app\Mail" },
    @{ From = "config\mailing.php"; To = "config\mailing.php" },
    @{ From = "resources\views\emails"; To = "resources\views\emails" }
)

foreach ($m in $maps) {
    $from = Join-Path $Source $m.From
    $toDir = Split-Path (Join-Path $Target $m.To) -Parent
    if (-not (Test-Path $toDir)) { New-Item -ItemType Directory -Force -Path $toDir | Out-Null }
    Copy-Item -Path $from -Destination (Join-Path $Target $m.To) -Recurse -Force
    Write-Host "Copied $($m.From) -> $($m.To)"
}

Write-Host ""
Write-Host "Done. Next steps:"
Write-Host "  1. Merge env.example into $Target\.env"
Write-Host "  2. cd $Target; composer dump-autoload; php artisan config:clear"
Write-Host "  3. Read README.md and copy example controllers/routes"
