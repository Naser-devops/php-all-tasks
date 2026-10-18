// Frontend validation (regex). Every input has data-rule="..." and is checked on blur + on submit.
const rules = {
  email:  v => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v) || 'Enter a valid email address',
  mobile: v => /^\d{14}$/.test(v) || 'Mobile must be exactly 14 digits',
  name:   v => /^\p{L}{2,30}$/u.test(v) || 'Letters only (2-30 characters)',
  loginpass: v => v.length > 0 || 'Password is required',
  password: v => {
    if (v.length < 8) return 'Password must be at least 8 characters';
    if (!/[A-Z]/.test(v)) return 'Add at least one uppercase letter';
    if (!/[a-z]/.test(v)) return 'Add at least one lowercase letter';
    if (!/\d/.test(v)) return 'Add at least one number';
    if (!/[^A-Za-z0-9\s]/.test(v)) return 'Add at least one special character';
    if (/\s/.test(v)) return 'Password must not contain spaces';
    return true;
  },
  optpass: v => v === '' ? true : rules.password(v),
};
function dobCheck(form) {
  const d = +form.day.value, m = +form.month.value, y = +form.year.value;
  if (!d || !m || !y) return 'Date of birth is required (DD / MM / YYYY)';
  const dt = new Date(y, m - 1, d);
  if (y < 1900 || dt.getFullYear() !== y || dt.getMonth() !== m - 1 || dt.getDate() !== d) return 'Invalid date of birth';
  const t = new Date(); let age = t.getFullYear() - y;
  if (t < new Date(t.getFullYear(), m - 1, d)) age--;
  return age >= 16 || 'You must be at least 16 years old to register';
}
document.querySelectorAll('form[data-validate]').forEach(form => {
  const fields = [...form.querySelectorAll('[data-rule]')];
  const isPass = r => ['password', 'loginpass', 'optpass'].includes(r);
  const show = (el, msg) => {
    el.classList.toggle('is-invalid', msg !== true);
    const fb = el.closest('.mb-3').querySelector('.invalid-feedback');
    if (fb) { fb.textContent = msg === true ? '' : msg; fb.style.display = msg === true ? 'none' : 'block'; }
  };
  const check = el => {
    const r = el.dataset.rule; let res;
    if (r === 'dob') res = dobCheck(form);
    else if (r === 'confirm') res = (el.value !== '' && el.value === form.password.value) || 'Passwords do not match';
    else res = rules[r](isPass(r) ? el.value : el.value.trim());
    show(el, res); return res === true;
  };
  fields.forEach(el => el.addEventListener('blur', () => check(el)));
  form.addEventListener('submit', ev => {
    let ok = true; fields.forEach(el => { if (!check(el)) ok = false; });
    if (!ok) ev.preventDefault();
  });
});
