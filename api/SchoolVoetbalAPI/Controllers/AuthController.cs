using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Identity.Data;
using Microsoft.AspNetCore.Mvc;
using SchoolVoetbalAPI.Data;
using SchoolVoetbalAPI.Models;
using System.ComponentModel.DataAnnotations;
using System.Linq;

namespace LoginRegisterAPI.Controllers
{
    public class RegisterRequest
    {
        [Required]
        [MaxLength(50)]
        public string Username { get; set; }

        [Required]
        [MinLength(6)]
        public string Password { get; set; }

        [Required]
        [EmailAddress] 
        public string Email { get; set; }
    }


    public class LoginRequest
    {
        [Required]
        public string UsernameOrEmail { get; set; }  

        [Required]
        [MinLength(6)]
        public string Password { get; set; }
    }


    [ApiController]
    [Route("api/[controller]")]
    public class AuthController : ControllerBase
    {
        private readonly ApplicationDbContext _context;
        private readonly PasswordHasher<User> _passwordHasher;

        public AuthController(ApplicationDbContext context)
        {
            _context = context;
            _passwordHasher = new PasswordHasher<User>();
        }

        [HttpPost("register")]
        public IActionResult Register([FromBody] RegisterRequest request)
        {
            // Check if the username or email already exists
            if (_context.Users.Any(u => u.username == request.Username || u.email == request.Email))
            {
                return BadRequest(new { message = "Username or email already exists." });
            }

            var user = new User
            {
                username = request.Username,
                password = _passwordHasher.HashPassword(null, request.Password),
                email = request.Email 
            };

            _context.Users.Add(user);
            _context.SaveChanges();

            return Ok(new { message = "User registered successfully." });
        }

        [HttpPost("login")]
        public IActionResult Login([FromBody] LoginRequest request)
        {
            var user = _context.Users.FirstOrDefault(u => u.username == request.UsernameOrEmail);

            if (user == null)
            {
                user = _context.Users.FirstOrDefault(u => u.email == request.UsernameOrEmail);

                if (user == null)
                {
                    return Unauthorized(new { message = "Invalid username or password." });
                }
            }


            var passwordVerificationResult = _passwordHasher.VerifyHashedPassword(user, user.password, request.Password);

            if (passwordVerificationResult == PasswordVerificationResult.Failed)
            {
                return Unauthorized(new { message = "Invalid username or password." });
            }

            return Ok(new { message = "Login successful." });
        }
    }

}
