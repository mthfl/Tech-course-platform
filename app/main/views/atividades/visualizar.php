<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#005A24">
    <title><?php echo isset($atividade['titulo']) ? htmlspecialchars($atividade['titulo']) : 'Atividade'; ?> - <?php echo APP_NAME; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 4px 25px -5px rgba(0, 90, 36, 0.3);
        }
        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            color: white;
            text-decoration: none;
        }
        .navbar .nav-menu {
            display: flex;
            list-style: none;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        .navbar .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .navbar .nav-menu a:hover {
            background: rgba(255, 165, 0, 0.2);
            transform: translateY(-2px);
        }
        .navbar .user-info {
            display: flex;
            gap: 15px;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            font-weight: 500;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        .activity-header {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
            margin-bottom: 30px;
            border: 2px solid #E6F4EA;
        }
        .activity-header h1 {
            color: #1A3C34;
            font-size: 32px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .activity-description {
            color: #6B7280;
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .activity-type {
            display: inline-block;
            padding: 8px 16px;
            background: #E6F4EA;
            color: #005A24;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .score-section {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
            margin-bottom: 30px;
            border: 2px solid #E6F4EA;
            text-align: center;
        }
        .score-section h3 {
            color: #1A3C34;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .score-display {
            font-size: 48px;
            font-weight: 700;
            color: #005A24;
            font-family: 'Poppins', sans-serif;
        }
        .score-display.passed {
            color: #7FB069;
        }
        .score-display.failed {
            color: #E76F51;
        }
        .questions-section {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
            border: 2px solid #E6F4EA;
        }
        .questions-section h2 {
            color: #1A3C34;
            font-size: 24px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 25px;
        }
        .question-item {
            background: linear-gradient(135deg, #F8FAF9 0%, #E6F4EA 100%);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            border-left: 4px solid #005A24;
            transition: all 0.3s;
        }
        .question-item:hover {
            border-left-color: #FFA500;
            box-shadow: 0 4px 12px rgba(0, 90, 36, 0.1);
        }
        .question-item.answered {
            border-left-color: #7FB069;
        }
        .question-item.answered.correct {
            background: linear-gradient(135deg, #E6F7ED 0%, #D4F1E0 100%);
        }
        .question-item.answered.incorrect {
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            border-left-color: #E76F51;
        }
        .question-text {
            color: #1A3C34;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
        }
        .question-number {
            display: inline-block;
            background: #005A24;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-weight: 700;
            margin-right: 10px;
            font-size: 14px;
        }
        .options-list {
            list-style: none;
        }
        .option-item {
            padding: 12px 18px;
            margin-bottom: 10px;
            background: white;
            border: 2px solid #E6F4EA;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .option-item:hover {
            border-color: #FFA500;
            transform: translateX(5px);
        }
        .option-item input[type="radio"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        .option-item label {
            flex: 1;
            cursor: pointer;
            color: #1A3C34;
            font-weight: 500;
        }
        .option-item.selected {
            border-color: #005A24;
            background: #E6F4EA;
        }
        .option-item.correct {
            border-color: #7FB069;
            background: #E6F7ED;
        }
        .option-item.incorrect {
            border-color: #E76F51;
            background: #FEE2E2;
        }
        .option-icon {
            font-size: 18px;
        }
        .option-icon.correct {
            color: #7FB069;
        }
        .option-icon.incorrect {
            color: #E76F51;
        }
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .alert-error {
            background: linear-gradient(135deg, #E76F51 0%, #F4A261 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 111, 81, 0.3);
        }
        .alert-success {
            background: linear-gradient(135deg, #7FB069 0%, #005A24 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 90, 36, 0.3);
        }
        .alert-info {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        .reward-badge {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 12px;
            margin-top: 20px;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(255, 165, 0, 0.3);
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #005A24 0%, #1A3C34 100%);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 90, 36, 0.3);
            cursor: pointer;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 90, 36, 0.4);
        }
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        @media (max-width: 768px) {
            .navbar .nav-menu {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo BASE_PATH; ?>/dashboard" class="logo">
                <?php echo APP_NAME; ?>
            </a>
            <ul class="nav-menu">
                <li><a href="<?php echo BASE_PATH; ?>/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/cursos"><i class="fas fa-book"></i> Cursos</a></li>
                <li><a href="<?php echo BASE_PATH; ?>/meus-cursos"><i class="fas fa-graduation-cap"></i> Meus Cursos</a></li>
                <li class="user-info">
                    <span><i class="fas fa-user-circle"></i> <?php echo ucfirst($_SESSION['usuario_nivel']); ?></span>
                    <span><i class="fas fa-coins"></i> <?php echo $_SESSION['usuario_coins']; ?></span>
                    <span><i class="fas fa-star"></i> <?php echo $_SESSION['usuario_xp']; ?> XP</span>
                </li>
                <li><a href="<?php echo BASE_PATH; ?>/logout"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?></span>
            </div>
        <?php endif; ?>
        
        
        <?php if (isset($atividade) && $atividade): ?>
        <div class="activity-header">
            <h1><?php echo htmlspecialchars($atividade['titulo']); ?></h1>
            <span class="activity-type"><?php echo ucfirst($atividade['tipo']); ?></span>
            <?php if (!empty($atividade['descricao'])): ?>
                <p class="activity-description"><?php echo nl2br(htmlspecialchars($atividade['descricao'])); ?></p>
            <?php endif; ?>
        </div>
        
        <?php if (isset($respostas_usuario) && count($respostas_usuario) > 0 && isset($nota)): ?>
            <div class="score-section">
                <h3><i class="fas fa-chart-line"></i> Sua Pontuação</h3>
                <div class="score-display <?php echo $nota >= 70 ? 'passed' : 'failed'; ?>">
                    <?php echo number_format($nota, 1); ?>%
                </div>
                <?php if ($nota >= 70): ?>
                    <p style="color: #7FB069; font-weight: 600; margin-top: 10px;">
                        <i class="fas fa-check-circle"></i> Parabéns! Você passou!
                    </p>
                <?php else: ?>
                    <p style="color: #E76F51; font-weight: 600; margin-top: 10px;">
                        <i class="fas fa-times-circle"></i> Você precisa de pelo menos 70% para passar.
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="questions-section">
            <h2><i class="fas fa-question-circle"></i> Perguntas</h2>
            
        <?php if (empty($perguntas) || !is_array($perguntas)): ?>
            <p style="color: #6B7280; text-align: center; padding: 40px;">
                Esta atividade ainda não possui perguntas cadastradas.
            </p>
        <?php else: ?>
                <form id="activityForm">
                    <input type="hidden" name="atividade_id" value="<?php echo isset($atividade['id']) ? $atividade['id'] : ''; ?>">
                    
                    <?php foreach ($perguntas as $index => $pergunta): ?>
                        <?php if (!isset($pergunta) || !is_array($pergunta)) continue; ?>
                        <?php 
                        $resposta_usuario = isset($respostas_usuario[$pergunta['id']]) ? $respostas_usuario[$pergunta['id']] : null;
                        $respondida = $resposta_usuario !== null;
                        $correta = $respondida && isset($resposta_usuario['pontuacao']) && $resposta_usuario['pontuacao'] > 0;
                        ?>
                        <div class="question-item <?php echo $respondida ? ($correta ? 'answered correct' : 'answered incorrect') : ''; ?>" 
                             data-pergunta-id="<?php echo $pergunta['id']; ?>">
                            <div class="question-text">
                                <span class="question-number"><?php echo $index + 1; ?></span>
                                <?php echo isset($pergunta['pergunta']) ? htmlspecialchars($pergunta['pergunta']) : 'Pergunta sem texto'; ?>
                            </div>
                            
                            <?php if (isset($pergunta['tipo']) && $pergunta['tipo'] === 'multipla_escolha' && !empty($pergunta['opcoes'])): ?>
                                <ul class="options-list">
                                    <?php foreach ($pergunta['opcoes'] as $opcao): ?>
                                        <?php 
                                        $selected = $respondida && $resposta_usuario['opcao_escolhida_id'] == $opcao['id'];
                                        $is_correct = $opcao['correta'] == 1;
                                        ?>
                                        <li class="option-item <?php 
                                            echo $selected ? 'selected' : ''; 
                                            echo $respondida && $is_correct ? ' correct' : '';
                                            echo $respondida && $selected && !$is_correct ? ' incorrect' : '';
                                        ?>">
                                            <input type="radio" 
                                                   name="pergunta_<?php echo $pergunta['id']; ?>" 
                                                   id="opcao_<?php echo $opcao['id']; ?>"
                                                   value="<?php echo $opcao['id']; ?>"
                                                   <?php echo $selected ? 'checked' : ''; ?>
                                                   <?php echo $respondida ? 'disabled' : ''; ?>>
                                            <label for="opcao_<?php echo $opcao['id']; ?>">
                                                <?php echo htmlspecialchars($opcao['texto_opcao']); ?>
                                            </label>
                                            <?php if ($respondida): ?>
                                                <?php if ($is_correct): ?>
                                                    <i class="fas fa-check-circle option-icon correct"></i>
                                                <?php elseif ($selected && !$is_correct): ?>
                                                    <i class="fas fa-times-circle option-icon incorrect"></i>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php elseif (isset($pergunta['tipo']) && $pergunta['tipo'] === 'verdadeiro_falso' && !empty($pergunta['opcoes'])): ?>
                                <ul class="options-list">
                                    <?php foreach ($pergunta['opcoes'] as $opcao): ?>
                                        <?php 
                                        $selected = $respondida && $resposta_usuario['opcao_escolhida_id'] == $opcao['id'];
                                        $is_correct = $opcao['correta'] == 1;
                                        ?>
                                        <li class="option-item <?php 
                                            echo $selected ? 'selected' : ''; 
                                            echo $respondida && $is_correct ? ' correct' : '';
                                            echo $respondida && $selected && !$is_correct ? ' incorrect' : '';
                                        ?>">
                                            <input type="radio" 
                                                   name="pergunta_<?php echo $pergunta['id']; ?>" 
                                                   id="opcao_<?php echo $opcao['id']; ?>"
                                                   value="<?php echo $opcao['id']; ?>"
                                                   <?php echo $selected ? 'checked' : ''; ?>
                                                   <?php echo $respondida ? 'disabled' : ''; ?>>
                                            <label for="opcao_<?php echo $opcao['id']; ?>">
                                                <?php echo htmlspecialchars($opcao['texto_opcao']); ?>
                                            </label>
                                            <?php if ($respondida): ?>
                                                <?php if ($is_correct): ?>
                                                    <i class="fas fa-check-circle option-icon correct"></i>
                                                <?php elseif ($selected && !$is_correct): ?>
                                                    <i class="fas fa-times-circle option-icon incorrect"></i>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php elseif (isset($pergunta['tipo']) && $pergunta['tipo'] === 'texto_livre'): ?>
                                <textarea name="pergunta_<?php echo $pergunta['id']; ?>" 
                                          class="form-control" 
                                          rows="4" 
                                          style="width: 100%; padding: 12px; border: 2px solid #E6F4EA; border-radius: 8px; font-family: 'Inter', sans-serif;"
                                          <?php echo $respondida ? 'disabled' : ''; ?>><?php echo $respondida ? htmlspecialchars($resposta_usuario['resposta_texto'] ?? '') : ''; ?></textarea>
                            <?php endif; ?>
                            
                            <?php if ($respondida): ?>
                                <div style="margin-top: 15px; padding: 10px; background: <?php echo $correta ? '#E6F7ED' : '#FEE2E2'; ?>; border-radius: 8px;">
                                    <small style="color: <?php echo $correta ? '#7FB069' : '#E76F51'; ?>; font-weight: 600;">
                                        <?php if ($correta): ?>
                                            <i class="fas fa-check-circle"></i> Resposta correta!
                                        <?php else: ?>
                                            <i class="fas fa-times-circle"></i> Resposta incorreta.
                                        <?php endif; ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php if (isset($respostas_usuario) && isset($perguntas) && count($respostas_usuario) < count($perguntas)): ?>
                        <div style="text-align: center; margin-top: 30px;">
                            <button type="button" id="submitActivity" class="btn">
                                <i class="fas fa-paper-plane"></i> Enviar Respostas
                            </button>
                        </div>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
            
            <?php if (isset($recompensa) && $recompensa && isset($nota) && $nota >= 70 && isset($recompensa_recebida) && $recompensa_recebida): ?>
                <div class="reward-badge">
                    <i class="fas fa-trophy"></i> Recompensa Recebida!
                    <?php if (!empty($recompensa['coins']) && $recompensa['coins'] > 0): ?>
                        <br><small>+<?php echo $recompensa['coins']; ?> coins</small>
                    <?php endif; ?>
                    <?php if (!empty($recompensa['xp']) && $recompensa['xp'] > 0): ?>
                        <br><small>+<?php echo $recompensa['xp']; ?> XP</small>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Erro ao carregar atividade. Tente novamente mais tarde.</span>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('activityForm');
            const submitBtn = document.getElementById('submitActivity');
            
            if (form && submitBtn) {
                // Adicionar eventos aos radio buttons
                const radioButtons = form.querySelectorAll('input[type="radio"]');
                radioButtons.forEach(radio => {
                    radio.addEventListener('change', function() {
                        const perguntaId = this.name.replace('pergunta_', '');
                        const opcaoId = this.value;
                        
                        // Enviar resposta via AJAX
                        enviarResposta(perguntaId, opcaoId);
                    });
                });
                
                // Adicionar eventos aos textareas
                const textareas = form.querySelectorAll('textarea');
                textareas.forEach(textarea => {
                    textarea.addEventListener('blur', function() {
                        const perguntaId = this.name.replace('pergunta_', '');
                        const respostaTexto = this.value;
                        
                        if (respostaTexto.trim()) {
                            enviarRespostaTexto(perguntaId, respostaTexto);
                        }
                    });
                });
                
                submitBtn.addEventListener('click', function() {
                    if (confirm('Tem certeza que deseja enviar suas respostas?')) {
                        location.reload();
                    }
                });
            }
        });
        
        function enviarResposta(perguntaId, opcaoId) {
            const form = document.getElementById('activityForm');
            const atividadeId = form.querySelector('input[name="atividade_id"]').value;
            
            const formData = new FormData();
            formData.append('atividade_id', atividadeId);
            formData.append('pergunta_id', perguntaId);
            formData.append('opcao_id', opcaoId);
            
            fetch('<?php echo BASE_PATH; ?>/responder-atividade', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Atualizar nota se exibida
                    if (data.nota !== undefined) {
                        const scoreDisplay = document.querySelector('.score-display');
                        if (scoreDisplay) {
                            scoreDisplay.textContent = data.nota.toFixed(1) + '%';
                            scoreDisplay.className = 'score-display ' + (data.nota >= 70 ? 'passed' : 'failed');
                        }
                    }
                    
                    // Se todas foram respondidas e passou, mostrar recompensa
                    if (data.todas_respondidas && data.nota >= 70 && data.recompensa) {
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            });
        }
        
        function enviarRespostaTexto(perguntaId, respostaTexto) {
            const form = document.getElementById('activityForm');
            const atividadeId = form.querySelector('input[name="atividade_id"]').value;
            
            const formData = new FormData();
            formData.append('atividade_id', atividadeId);
            formData.append('pergunta_id', perguntaId);
            formData.append('resposta_texto', respostaTexto);
            
            fetch('<?php echo BASE_PATH; ?>/responder-atividade', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Atualizar nota se exibida
                    if (data.nota !== undefined) {
                        const scoreDisplay = document.querySelector('.score-display');
                        if (scoreDisplay) {
                            scoreDisplay.textContent = data.nota.toFixed(1) + '%';
                            scoreDisplay.className = 'score-display ' + (data.nota >= 70 ? 'passed' : 'failed');
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            });
        }
    </script>
</body>
</html>

