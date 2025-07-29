    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>关于博客</h3>
                    <p>一个专注于Web开发、设计思维与技术前沿的个人博客，分享知识与见解。</p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path fill="currentColor" d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path fill="currentColor" d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124-4.09-.193-7.715-2.157-10.141-5.126-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 14-7.503 14-14v-.617c.961-.689 1.8-1.56 2.46-2.548z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path fill="currentColor" d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667h-3.554v-11.452h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zm-15.11-13.019c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019h-3.564v-11.452h3.564v11.452z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h3>热门分类</h3>
                    <ul class="footer-links">
                        <li><a href="#">前端开发</a></li>
                        <li><a href="#">后端技术</a></li>
                        <li><a href="#">UI/UX设计</a></li>
                        <li><a href="#">JavaScript框架</a></li>
                        <li><a href="#">数据库技术</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>实用链接</h3>
                    <ul class="footer-links">
                        <li><a href="index.php">首页</a></li>
                        <li><a href="about.php">关于我们</a></li>
                        <li><a href="contact.php">联系我们</a></li>
                        <li><a href="#">隐私政策</a></li>
                        <li><a href="#">使用条款</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>订阅更新</h3>
                    <p>订阅我们的新闻通讯，获取最新文章和更新。</p>
                    <form class="subscribe-form">
                        <input type="email" placeholder="您的电子邮箱" required>
                        <button type="submit" class="btn btn-primary">订阅</button>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; <?= date('Y') ?> 现代个人博客. 保留所有权利。
                </div>
                <div class="theme-settings">
                    <span>主题色:</span>
                    <input type="color" id="theme-color-picker" value="<?= get_theme_color() ?>">
                </div>
            </div>
        </div>
    </footer>
    
    <script src="assets/js/main.js"></script>
    <script>
        // 主题切换功能
        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                document.documentElement.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', document.documentElement.classList.contains('dark-mode'));
            });
        }
        
        // 主题色选择器
        const colorPicker = document.getElementById('theme-color-picker');
        if (colorPicker) {
            colorPicker.addEventListener('input', function() {
                document.documentElement.style.setProperty('--primary-color', this.value);
                
                // 保存到本地存储（实际应用中应该保存到服务器）
                localStorage.setItem('customThemeColor', this.value);
                
                // 在实际应用中，这里应该发送AJAX请求更新服务器配置
                console.log('主题色已更新:', this.value);
            });
        }
        
        // 检查本地存储中的暗色模式设置
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark-mode');
        }
        
        // 检查本地存储中的自定义主题色
        const savedColor = localStorage.getItem('customThemeColor');
        if (savedColor) {
            document.documentElement.style.setProperty('--primary-color', savedColor);
            if (colorPicker) colorPicker.value = savedColor;
        }
    </script>
</body>
</html>