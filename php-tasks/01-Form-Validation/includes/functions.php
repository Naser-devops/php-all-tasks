<?php
// ---------- Shared helpers for the Login / Sign-up project ----------
if (session_status() === PHP_SESSION_NONE) session_start();

const USERS_FILE  = __DIR__ . '/../users.json';   // our "database": an associative array saved as JSON
const ADMIN_EMAIL = 'admin@admin.com';            // super user
const ADMIN_PASS  = 'Admin@12345';

function e($s): string { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function load_users(): array {
    if (!file_exists(USERS_FILE)) return [];
    $d = json_decode(file_get_contents(USERS_FILE), true);
    return is_array($d) ? $d : [];
}
function save_users(array $users): void {
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function find_user_by_email(string $email): ?array {
    foreach (load_users() as $u) if (strcasecmp($u['email'], $email) === 0) return $u;
    return null;
}
function next_id(array $users): int { return $users ? max(array_keys($users)) + 1 : 1; }

// ---------- Validation (backend) : same rules as js/validate.js ----------
function validate_user(array $d, bool $isSignup = true, ?int $ignoreId = null): array {
    $err = [];
    $email = trim($d['email'] ?? '');
    if ($email === '') $err['email'] = 'Email is required';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/', $email))
        $err['email'] = 'Enter a valid email address';
    else {
        $other = find_user_by_email($email);
        if ($other && (int)$other['id'] !== (int)$ignoreId) $err['email'] = 'This email is already registered';
    }

    $mobile = trim($d['mobile'] ?? '');
    if ($mobile === '') $err['mobile'] = 'Mobile is required';
    elseif (!preg_match('/^\d{14}$/', $mobile)) $err['mobile'] = 'Mobile must be exactly 14 digits';

    foreach (['fname' => 'First name', 'mname' => 'Middle name', 'lname' => 'Last name', 'family' => 'Family name'] as $k => $label) {
        $v = trim($d[$k] ?? '');
        if ($v === '') $err[$k] = "$label is required";
        elseif (!preg_match('/^\p{L}{2,30}$/u', $v)) $err[$k] = "$label: letters only (2-30 characters)";
    }

    $pass = $d['password'] ?? '';
    if ($isSignup || $pass !== '') {
        if ($pass === '') $err['password'] = 'Password is required';
        elseif (strlen($pass) < 8) $err['password'] = 'Password must be at least 8 characters';
        elseif (!preg_match('/[A-Z]/', $pass)) $err['password'] = 'Add at least one uppercase letter';
        elseif (!preg_match('/[a-z]/', $pass)) $err['password'] = 'Add at least one lowercase letter';
        elseif (!preg_match('/\d/', $pass))    $err['password'] = 'Add at least one number';
        elseif (!preg_match('/[^A-Za-z0-9\s]/', $pass)) $err['password'] = 'Add at least one special character';
        elseif (preg_match('/\s/', $pass))     $err['password'] = 'Password must not contain spaces';
        if ($isSignup && !isset($err['password']) && $pass !== ($d['confirm'] ?? '')) $err['confirm'] = 'Passwords do not match';
    }

    if ($isSignup) {
        $day = (int)($d['day'] ?? 0); $mon = (int)($d['month'] ?? 0); $year = (int)($d['year'] ?? 0);
        if (!$day || !$mon || !$year) $err['dob'] = 'Date of birth is required (DD / MM / YYYY)';
        elseif (!checkdate($mon, $day, $year) || $year < 1900) $err['dob'] = 'Invalid date of birth';
        else {
            $age = (new DateTime(sprintf('%04d-%02d-%02d', $year, $mon, $day)))->diff(new DateTime('today'))->y;
            if ($age < 16) $err['dob'] = 'You must be at least 16 years old to register';
        }
    }
    return $err;
}

// ---------- HTML helpers ----------
function page_header(string $title, ?string $back = null): void { ?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($title) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css"></head><body>
<div class="phone"><?php if ($back): ?><a class="back" href="<?= e($back) ?>">&#8249;</a><?php endif;
}
function page_footer(bool $validate = false): void {
    echo '</div>';
    if ($validate) echo '<script src="js/validate.js"></script>';
    echo '</body></html>';
}
function field(string $name, string $label, string $type, array $old, array $err, string $rule, string $extra = ''): void { ?>
<div class="mb-3">
  <label class="form-label" for="<?= $name ?>"><?= e($label) ?></label>
  <input class="form-control <?= isset($err[$name]) ? 'is-invalid' : '' ?>" id="<?= $name ?>" name="<?= $name ?>" type="<?= $type ?>"
         data-rule="<?= $rule ?>" value="<?= $type === 'password' ? '' : e($old[$name] ?? '') ?>" <?= $extra ?>>
  <div class="invalid-feedback"><?= e($err[$name] ?? '') ?></div>
</div>
<?php }
