using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Description;
using WebApi.Models;

namespace WebApi.Controllers
{
    [Authorize]
    public class ProblemsController : ApiController
    {
        private CarServiceDB db = new CarServiceDB();

        // GET: api/Problems
        public IQueryable<Problem> GetProblems()
        {
            return db.Problems;
        }

        // GET: api/Problems/5
        [ResponseType(typeof(Problem))]
        public IHttpActionResult GetProblem(long id)
        {
            Problem problem = db.Problems.Find(id);
            if (problem == null)
            {
                return NotFound();
            }

            return Ok(problem);
        }

        // GET: api/Problems?name={name}
        [ResponseType(typeof(List<Problem>))]
        public IQueryable<Problem> GetProblem(string name)
        {
            if (name==null)
            {
                return db.Problems;
            }
            var problem = db.Problems;
            List<Problem> problems = new List<Problem>();
            foreach (var pbl in problem)
            {
                if (pbl.Name.ToLower().Contains(name.ToLower()))
                {
                    problems.Add(pbl);
                }
            }

            return problems.AsQueryable<Problem>();
        }

        // PUT: api/Problems/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutProblem(long id, Problem problem)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != problem.ProblemId)
            {
                return BadRequest();
            }

            db.Entry(problem).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!ProblemExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/Problems
        [ResponseType(typeof(Problem))]
        public IHttpActionResult PostProblem(Problem problem)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (CheckProblemFields(problem))
            {
                db.Problems.Add(problem);
                db.SaveChanges();

                return CreatedAtRoute("DefaultApi", new { id = problem.ProblemId }, problem);
            }
            else
            {
                return BadRequest();
            }
        }

        private bool CheckProblemFields(Problem problem)
        {
            if (problem.Name==null|| problem.Name.Length>50)
            {
                return false;
            }
            else if (problem.Duration<0)
            {
                return false;
            }
            else if (problem.Price<0)
            {
                return false;
            }
            else if (problem.Descrioption==null|| problem.Descrioption.Length>150)
            {
                return false;
            }
            return true;
        }

        // DELETE: api/Problems/5
        [ResponseType(typeof(Problem))]
        public IHttpActionResult DeleteProblem(long id)
        {
            Problem problem = db.Problems.Find(id);
            if (problem == null)
            {
                return NotFound();
            }

            db.Problems.Remove(problem);
            db.SaveChanges();

            return Ok(problem);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool ProblemExists(long id)
        {
            return db.Problems.Count(e => e.ProblemId == id) > 0;
        }
    }
}