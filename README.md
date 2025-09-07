# OD WordPress Theme

A modern, secure, and responsive WordPress theme built with custom PHP, SCSS, and enterprise-grade security features.

![WordPress Version](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue.svg)
![License](https://img.shields.io/badge/License-GPL%20v2-green.svg)

## 🚀 Features

### **🎨 Modern Design**
- Clean, minimalist interface
- Fully responsive design
- Mobile-first approach
- Cross-browser compatibility
- Custom navigation system with hover effects

### **🛡️ Enterprise-Grade Security**
- **Attack Prevention**: SQL injection, XSS, CSRF protection
- **Content Security Policy**: Development and production modes
- **Login Security**: Rate limiting, brute force prevention
- **File Upload Security**: Dangerous file type filtering
- **Session Security**: Secure session handling
- **Input Sanitization**: All outputs properly escaped
- **Security Headers**: X-Frame-Options, XSS Protection, HSTS

### **⚡ Performance Optimized**
- Optimized asset loading
- Clean, semantic code
- Efficient SCSS architecture
- Minimal JavaScript footprint
- Fast loading times

### **📱 Responsive Design**
- Mobile-first responsive design
- Tablet-optimized layouts
- Desktop enhancements
- Touch-friendly navigation
- Consistent experience across devices

## 📋 Requirements

- **WordPress**: 6.0 or higher
- **PHP**: 8.0 or higher
- **MySQL**: 5.7 or higher
- **Node.js**: 16+ (for development)
- **npm/yarn**: Latest version (for development)

## 🔧 Installation

### **Method 1: Direct Upload**
1. Download the theme files
2. Upload to `/wp-content/themes/OD-Theme/`
3. Activate in WordPress Admin → Appearance → Themes

### **Method 2: WordPress Admin**
1. Go to WordPress Admin → Appearance → Themes
2. Click "Add New" → "Upload Theme"
3. Select the theme ZIP file
4. Click "Install Now" and then "Activate"

### **Method 3: Development Setup**
```bash
# Clone the repository
git clone https://github.com/onethdias07/OD-Wordpress-Theme.git

# Navigate to theme directory
cd OD-Wordpress-Theme

# Install development dependencies
npm install

# Build assets
npm run build

# For development with watch mode
npm run dev
```

## 🏗️ Theme Structure

```
OD-Theme/
├── src/
│   ├── scss/
│   │   ├── abstracts/
│   │   ├── base/
│   │   ├── components/
│   │   ├── layout/
│   │   └── pages/
│   ├── js/
│   └── images/
├── dist/
│   ├── app.css
│   └── app.js
├── includes/
│   ├── security-config.php
│   └── section-*.php
├── functions.php
├── style.css
├── index.php
├── header.php
├── footer.php
└── README.md
```

## 🎯 Usage

### **Navigation Setup**
1. Go to WordPress Admin → Appearance → Menus
2. Create a new menu
3. Assign it to "Header Nav" location

### **Custom Post Types**
The theme includes a custom "News" post type:
- Archive page: `/news/`
- Single posts: `/news/post-name/`
- Custom taxonomy: News Categories

### **Sidebar Configuration**
- **Page Sidebar**: For pages
- **Blog Sidebar**: For blog posts
- Configure in WordPress Admin → Appearance → Widgets

### **Security Features**
All security features are automatically active. See `SECURITY-CHECKLIST.md` for maintenance tasks.

## 🛠️ Development

### **Build Process**
```bash
# Install dependencies
npm install

# Development build with watch
npm run dev

# Production build
npm run build

# SCSS compilation only
npm run scss

# JavaScript compilation only
npm run js
```

### **SCSS Architecture**
- **Abstracts**: Variables, functions, mixins
- **Base**: Reset, typography, base styles
- **Components**: Buttons, forms, cards
- **Layout**: Header, footer, grid, navigation
- **Pages**: Page-specific styles

### **JavaScript Features**
- Mobile menu functionality
- Search form interactions
- Smooth scrolling effects
- Touch gesture support
- Performance optimizations

## 🔒 Security

This theme implements comprehensive security measures:

### **Built-in Protection**
- ✅ SQL Injection Prevention
- ✅ XSS (Cross-Site Scripting) Protection
- ✅ CSRF (Cross-Site Request Forgery) Protection
- ✅ Brute Force Login Protection
- ✅ File Upload Security
- ✅ Content Security Policy
- ✅ Security Headers
- ✅ Input Sanitization
- ✅ Output Escaping

### **Security Maintenance**
- Weekly security log reviews
- Monthly security updates
- Quarterly security audits
- See `SECURITY-CHECKLIST.md` for detailed tasks

## 🌐 Browser Support

- **Chrome**: 90+
- **Firefox**: 88+
- **Safari**: 14+
- **Edge**: 90+
- **Mobile browsers**: iOS Safari 14+, Chrome Mobile 90+

## 📱 Responsive Breakpoints

```scss
$breakpoint-small: 576px;   // Mobile
$breakpoint-tablet: 768px;  // Tablet
$breakpoint-medium: 992px;  // Small desktop
$breakpoint-large: 1200px;  // Large desktop
```

## 🎨 Customization

### **Colors**
```scss
$main-text: #212121;        // Primary text color
$body-bg: #FFFFE3;          // Background color
$font-primary: 'Zodiak';    // Heading font
$font-secondary: 'Plus Jakarta Sans'; // Body font
```

### **Typography**
- **Headings**: Zodiak font family
- **Body text**: Plus Jakarta Sans
- **Font sizes**: Responsive scaling
- **Line heights**: Optimized for readability

### **Layout**
- **Container max-width**: 1200px
- **Grid system**: CSS Grid and Flexbox
- **Spacing**: Consistent scale (15px, 20px, 25px, 30px)

## 🔧 Configuration

### **WordPress Features**
```php
// Enabled theme supports
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');

// Custom image sizes
add_image_size('blog-large', 800, 600, false);
add_image_size('blog-small', 400, 300, true);
```

### **Security Configuration**
Security settings are automatically configured. To modify:
- Edit `includes/security-config.php`
- Review `functions.php` security section
- Check `.htaccess` rules

## 📈 Performance

### **Optimization Features**
- Minified CSS and JavaScript
- Optimized image loading
- Efficient database queries
- Minimal HTTP requests
- Proper caching headers

### **Performance Tips**
- Use WebP images when possible
- Enable WordPress caching
- Optimize database regularly
- Monitor Core Web Vitals

## 🐛 Troubleshooting

### **Common Issues**

**Styles not loading:**
```bash
# Rebuild assets
npm run build
```

**JavaScript errors:**
- Check browser console
- Verify jQuery is loaded
- Clear browser cache

**Security errors:**
- Review error logs
- Check CSP violations
- Verify file permissions

**Mobile menu not working:**
- Check JavaScript console
- Verify touch events
- Clear browser cache

## 📝 Changelog

### **Version 1.0.0** (September 2025)
- ✅ Initial release
- ✅ Modern responsive design
- ✅ Enterprise security features
- ✅ Custom post types
- ✅ Mobile navigation
- ✅ Performance optimizations

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

### **Development Guidelines**
- Follow WordPress coding standards
- Write secure code
- Test on multiple devices
- Document changes
- Update version numbers

## 📄 License

This theme is licensed under the GPL v2 or later.
```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
```

## 👨‍💻 Author

**Oneth Dias**
- GitHub: [@onethdias07](https://github.com/onethdias07)
- Email: [theonethdias](theonethdias@gmail.com)

## 🆘 Support

### **Documentation**
- `SECURITY-CHECKLIST.md` - Security maintenance guide
- WordPress Codex - WordPress documentation
- Theme files include inline comments

### **Getting Help**
- Check the troubleshooting section
- Review security checklist
- Submit GitHub issues
- Contact theme author

### **Reporting Security Issues**
Please report security vulnerabilities privately to maintain user safety.

---

**Made with ❤️ for WordPress**

*This theme demonstrates modern WordPress development practices with a focus on security, performance, and user experience.*
