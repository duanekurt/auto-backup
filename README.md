# Savants Auto Backup

Automatic Database Backup 

---

## Installation

### Setup

- To install the package

> composer require savants/auto-backup
> 
- After that add this to your `app/Command/Kernel.php`
```php
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('db:backup')->daily()->at('23:40'); // set your type of backup time and date
    }
```

- Add this to your env

```env
DUMP_PATH=        // path to your mysqldump
```

## License

[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://badges.mit-license.org)

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2020 © Savants
